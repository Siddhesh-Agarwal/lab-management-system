<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content');
    }

    public function tables()
    {
        return view('admin.tables');
    }

    public function device_details()
    {
        return view('admin.devicedetails');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function forceLogout()
    {
        $logs = Student::where('isLoggedIn', 1)->get();
        $count = Student::where('isLoggedIn', 1)->count();

        $student = Student::all();
        // dd($count);
        foreach ($logs as $log) {
            $log->update(['isLoggedIn' => 0]);
        }

        foreach ($student as $stud) {
            $stud->update(['systemNumber' => 0]);
        }

        $message = sprintf("Total force logout %s", $count);

        return redirect()->action([AdminController::class, 'index'])->with('message', $message);
    }
    public function save_student(Request $request)
    {

        $request->validate([
            'rollno' => 'required',
        ]);

        $data = [
            'rollno' => $request->input('rollno'),
            'systemNumber' => $this->generateSystemNumber(),
            'labname' => urldecode($request->labname),
        ];

        $res = Student::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();

        $workedTime = 0;
        $InTime = 0;
        $OutTime = 0;

        if (is_null($res)) {
            
            Student::create($data);

            Logs::create(array(
                'rollno' => $request->rollno,
                'systemNumber' => $data['systemNumber'], 
                'labname' => urldecode($request->labname),
                'random' => 0,
            ));
            
            $stud = Student::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();
            $stud->update(['isLoggedIn' => 1]);
            $InTime = $stud->updated_at;
            $message = sprintf("Welcome %s!<br>You are in!<br>Your system number is %d", $request->input('rollno'), $data['systemNumber']);

            return redirect()->action([AdminController::class, 'index'])->with('message', $message);
            
        } else {

            if ($res->isLoggedIn === 0) {
                Logs::create(array(
                    'rollno' => $res->rollno,
                    'systemNumber' => $res->systemNumber,
                    'labname' => $request->labname,
                    'random' => 0,
                ));

                $res->update(['isLoggedIn' => 1]);

                $InTime = $res->updated_at;
                $message = sprintf("Welcome %s!<br>You are in!<br>Your system number is %d", $request->input('rollno'), $data['systemNumber']);

                return redirect()->action([AdminController::class, 'index'])->with('message', $message);
            }
        }

        $res->update(['isLoggedIn' => 0, 'systemNumber' => 0]);

        $leaving = Logs::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();
        $val = $leaving->random + 1;
        $leaving->update(['random' => $val]);

        $InTime = $res->updated_at;
        $OutTime = $leaving->created_at;

        $startTimestamp = Carbon::parse($InTime);
        $endTimestamp = Carbon::parse($OutTime);

        sprintf("%s has successfully", $startTimestamp);

        $timeDifference = $startTimestamp->diff($endTimestamp)->format('%H:%I:%S');

        // gmdate('H:i:s', $workedTime)
        $message = sprintf("%s has successfully Logged out !     worked time %d minutes", $request->input('rollno'), $timeDifference);

        return redirect()->action([AdminController::class, 'index'])->with('message', $message);

    }

    public function generateSystemNumber()
    {
        // Generate a random system number (you can modify this based on your requirements)
        return rand(1, 66); // Assuming system numbers are within 1 to 60 range
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = Student::all();

        return view('admin.tables', compact('data'));
    }

    public function simple_search()
    {
        return view('admin.simplesearch');
    }

    public function advance_search()
    {
        return view('admin.advancesearch');
    }

    public function contact()
    {
        return view('admin.contact');
    }

    public function searchBySerial(Request $request)
    {
        $lab_name=Auth::user()->labname;
        $searchTerm = $request->input('search_term');
        $results=Lab::where('serial_number','LIKE','%'.$searchTerm.'%')
                    //   ->where('lab_name',$lab_name)
        ->get();
        // dd($results);
        return view('admin.simplesearch', ['results' => $results]);

    }
    public function searchByDevice(Request $request)
    {
        $searchTerm = $request->input('search_termd');
        $resultd=Lab::where('device_name','LIKE','%'.$searchTerm.'%')->get();
        // dd($resultd);
        return view('admin.simplesearch', ['resultd' => $resultd]);

    }
    public function searchBySystem(Request $request)
    {
        $searchTerm = $request->input('search_terms');
        $result=Lablist::where('system_number','LIKE','%'.$searchTerm.'%')->get();
        // dd($result);
        return view('admin.simplesearch', ['result' => $result]);

    }
    public function searchByLabSerial(Request $request)
    {
        $lab_name=Auth::user()->labname;
        $searchTerm = $request->input('search_term');
        $results=Lab::where('serial_number','LIKE','%'.$searchTerm.'%')
                     ->where('lab_name',$lab_name)
        ->get();
        // dd($results);
        return view('admin.labsearch', ['results' => $results]);

    }
    public function searchByLabDevice(Request $request)
    {
        $lab_name=Auth::user()->labname;
        $searchTerm = $request->input('search_termd');
        $resultd=Lab::where('device_name','LIKE','%'.$searchTerm.'%')
                      ->where('lab_name',$lab_name)
        ->get();
        // dd($resultd);
        return view('admin.labsearch', ['resultd' => $resultd]);

    }
    public function searchByLabSystem(Request $request)
    {
        $lab_name=Auth::user()->labname;
        $searchTerm = $request->input('search_terms');
        $result=Lablist::where('system_number','LIKE','%'.$searchTerm.'%')
                        ->where('lab_name',$lab_name)
        
        ->get();
        // dd($result);
        return view('admin.labsearch', ['result' => $result]);

    }

}
