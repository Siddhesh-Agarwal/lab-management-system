<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Lablist;
use App\Models\Lab_Table;
use App\Models\Logs;
use App\Models\Student;
use App\Models\StudentRecord;
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
        $data_box = session('data_box');

        $wow = Auth::user()->labname;

        $labNames = Lab_Table::get();
        $labcount = Lab_Table::count();

        $student = Student::where('isLoggedIn', 1)->where('labname', $wow)->count();
        $systemcount = Lablist::where('lab_name', Auth::user()->labname)->count();
        $devicecount = Lab::where('lab_name', Auth::user()->labname)->sum('count');

        return view('admin.content', ['data_box' => $data_box, 'labNames' => $labNames, 'login_count' => $student, 'systemcount' => $systemcount, 'devicecount' => $devicecount, 'labcount' => $labcount]);
    }

    public function tables()
    {
        $student = Student::where('labname', Auth::user()->labname)->get();
        $labNames = Lab_Table::get();
        return view('admin.studentTable', ['students' => $student, 'labNames' => $labNames]);
    }

    public function device_detasils()
    {
        $labNames = Lab_Table::get();
        return view('admin.devicedetails', ['labNames' => $labNames]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Successfully logged out !');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function forceLogout()
    {
        $logs = Student::where('isLoggedIn', 1)->where('labname', Auth::user()->labname)->get();
        $count = Student::where('isLoggedIn', 1)->count();

        $student = Student::all();

        foreach ($logs as $log) {
            $log->update(['isLoggedIn' => 0]);
            $log->delete();
        }

        foreach ($student as $stud) {
            $stud->update(['systemNumber' => 0]);
        }

        $message = sprintf("Total force logout %d", $count);

        return redirect()->action([AdminController::class, 'index'])->with('message', $message);
    }
    public function save_student(Request $request)
    {

        $request->validate([
            'rollno' => 'required',
        ]);

        $main = StudentRecord::where('regNo', '=', $request->input('rollno'))->first();
        $res = Student::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();
        
        $lab = Lab_Table::where('lab_name', '=', urldecode($request->labname))->first();

        // Get the last allocated system number
        $lastAllocatedSystem = Student::where('labname', '=', urldecode($request->labname))
            ->orderBy('id', 'desc')
            ->limit(1)
            ->pluck('systemNumber')
            ->first();

// Calculate the next system number based on the last allocated system
        if ($lastAllocatedSystem) {
            $systemParts = explode('-', $lastAllocatedSystem);
            $systemNumber = intval($systemParts[2]); // Convert to integer
            $nextSystemNumber = $systemNumber + 1;
        } else {
            $nextSystemNumber = 1;
        }

        $count = Lablist::where('lab_name', Auth::user()->labname)->get()->count();
        $limit = 0;
        if ($limit < $count) {
            // Allocate systems to the student
            $allocatedSystems = [];
            for ($i = 0; $i < $count; $i++) {
                $limit++;
                $systemNumber = sprintf("SK-%s-%d", $lab->lab_code, $nextSystemNumber);
                $allocatedSystems[] = $systemNumber;
                $nextSystemNumber++;
            }
        } else {
            dd("alert");
        }

        $data = [
            'name' => $main->name,
            'rollno' => $request->input('rollno'),
            'email' => $main->email,
            'degree' => $main->degree,
            'branch' => $main->branch,
            'pic' => $main->pic,
            'systemNumber' => $allocatedSystems[0],
            'labname' => urldecode($request->labname),
        ];

        $InTime = 0;
        $OutTime = 0;

        if (is_null($res)) {

            $master = Student::create($data);
        
            $system_number = sprintf("SK-%s-%d", $lab->lab_code, $data['systemNumber']);

            Logs::create(array(
                'rollno' => $request->rollno,
                'system_number' => $data['systemNumber'],
                'labname' => urldecode($request->labname),
                'login_time' => $master->created_at,
                'random' => 0,
            ));

            $stud = Student::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();
            $stud->update(['isLoggedIn' => 1]);
            $message = sprintf("Your system number is %s", $data['systemNumber']);
            $InTime = $stud->updated_at;

            $count = Student::where('isLoggedIn', 1)->count();

            $data_box = [
                "datas" => $data,
                "message" => $message,
                "logins" => $count,
                "type" => "login",
            ];
            // dd($data_box);
            return redirect()->action([AdminController::class, 'index'])->with('data_box', $data_box);

        } else {
            if ($res->isLoggedIn === 0) {

                $already_log = Student::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();

                Logs::create(array(
                    'rollno' => $res->rollno,
                    'system_number' => $already_log->system_number,
                    'labname' => urldecode($request->labname),
                    'random' => 0,
                ));

                $res->update(['isLoggedIn' => 1]);

                $InTime = $res->updated_at;
                $message = sprintf("Your system number is %s", $data['systemNumber']);
                $count = Student::where('isLoggedIn', 1)->count();

                $data_box = [
                    "datas" => $data,
                    "message" => $message,
                    "logins" => $count,
                    "type" => "login",
                ];

                return redirect()->action([AdminController::class, 'index'])->with('data_box', $data_box);
            }
        }

        $res->update(['isLoggedIn' => 0, 'system_number' => 0]);

        $leaving = Logs::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();

        $val = $leaving->random + 1;

        $leaving->update(['random' => $val]);

        $InTime = $res->logout_time;
        $OutTime = $leaving->login_time;

        $startTimestamp = Carbon::parse($InTime);
        $endTimestamp = Carbon::parse($OutTime);

        sprintf("%s has successfully", $startTimestamp);

        $timeDifference = $endTimestamp->diffInMinutes($startTimestamp);

        Student::where('rollno', '=', $request->input('rollno'))->delete();

        $message = sprintf("Successfully Logged out ! worked time %d minutes", $timeDifference);

        $count = Student::where('isLoggedIn', 1)->count();

        $data_box = [
            "datas" => $data,
            "message" => $message,
            "logins" => $count,
            "type" => "logout",
        ];
        return redirect()->action([AdminController::class, 'index'])->with('data_box', $data_box);

    }

    public function generateSystemNumber()
    {
        $count = Lablist::where('lab_name', Auth::user()->labname)->get()->count();
        return rand(1, $count); // Assuming system numbers are within 1 to 60 range
    }

    public function show()
    {
        $data = Student::all();
        $labNames = Lab_Table::get();
        return view('admin.tables', ['data' => $data, 'labNames' => $labNames]);
    }

    public function simple_search()
    {
        $labNames = Lab_Table::get();
        return view('admin.simplesearch', ['labNames' => $labNames]);
    }

    public function advance_search()
    {
        $labNames = Lab_Table::get();
        return view('admin.advancesearch', ['labNames' => $labNames]);
    }

    public function contact()
    {
        $labNames = Lab_Table::get();
        return view('admin.contact', ['labNames' => $labNames]);
    }

    public function searchBySerial(Request $request)
    {
        $labNames = Lab_Table::get();
        $lab_name = Auth::user()->labname;
        $searchTerm = $request->input('search_term');
        $results = Lab::where('serial_number', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return view('admin.simplesearch', ['results' => $results, 'labNames' => $labNames]);

    }

    public function searchByDevice(Request $request)
    {
        $labNames = Lab_Table::get();
        $searchTerm = $request->input('search_termd');
        $resultd = Lab::where('device_name', 'LIKE', '%' . $searchTerm . '%')->get();
        // dd($resultd);
        return view('admin.simplesearch', ['resultd' => $resultd, 'labNames' => $labNames]);

    }
    public function searchBySystem(Request $request)
    {
        $labNames = Lab_Table::get();
        $searchTerm = $request->input('search_terms');
        $result = Lablist::where('system_number', 'LIKE', '%' . $searchTerm . '%')->get();
        return view('admin.simplesearch', ['result' => $result, 'labNames' => $labNames]);

    }
    public function searchByLabSerial(Request $request)
    {
        $labNames = Lab_Table::get();
        $lab_name = Auth::user()->labname;
        $searchTerm = $request->input('search_term');
        $results = Lab::where('serial_number', 'LIKE', '%' . $searchTerm . '%')
            ->where('lab_name', $lab_name)->get();
        return view('admin.simplesearch', ['results' => $results, 'labNames' => $labNames]);

    }
    public function searchByLabDevice(Request $request)
    {
        $labNames = Lab_Table::get();
        $lab_name = Auth::user()->labname;
        $searchTerm = $request->input('search_termd');
        $resultd = Lab::where('device_name', 'LIKE', '%' . $searchTerm . '%')
            ->where('lab_name', $lab_name)
            ->get();
        return view('admin.simplesearch', ['resultd' => $resultd, 'labNames' => $labNames]);
    }
    public function searchByLabSystem(Request $request)
    {
        $labNames = Lab_Table::get();
        $lab_name = Auth::user()->labname;
        $searchTerm = $request->input('search_terms');
        $result = Lablist::where('system_number', 'LIKE', '%' . $searchTerm . '%')
            ->where('lab_name', $lab_name)
            ->get();
        return view('admin.simplesearch', ['result' => $result, 'labNames' => $labNames]);
    }
}
