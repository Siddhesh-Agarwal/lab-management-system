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
        $labNames = Lab_Table::get();
        return view('admin.content', ['data_box' => $data_box, 'labNames' => $labNames]);
    }

    public function tables()
    {
        $labNames = Lab_Table::get();
        return view('admin.tables', ['labNames' => $labNames]);
    }

    public function device_details()
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
        $logs = Student::where('isLoggedIn', 1)->get();
        $count = Student::where('isLoggedIn', 1)->count();

        $student = Student::all();

        foreach ($logs as $log) {
            $log->update(['isLoggedIn' => 0]);
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

        $data = [
            'name' => $main->name,
            'rollno' => $request->input('rollno'),
            'degree' => $main->degree,
            'branch' => $main->branch,
            'pic' => $main->pic,
            'systemNumber' => $this->generateSystemNumber(),
            'labname' => urldecode($request->labname),
        ];

        $workedTime = 0;
        $InTime = 0;
        $OutTime = 0;

        if (is_null($res)) {

            Student::create($data);

            Logs::create(array(
                'rollno' => $request->rollno,
                'systemNumber' => $data['systemNumber'],
                'labname' => $request->labname,
                'random' => 0,
            ));

            $stud = Student::where('rollno', '=', $request->input('rollno'))->latest()->get()->first();
            $stud->update(['isLoggedIn' => 1]);
            $InTime = $stud->updated_at;
            $message = sprintf("Your system number is SK-%s-%d", $lab->lab_code, $data['systemNumber']);

            $count = Student::where('isLoggedIn', 1)->count();

            $data_box = [
                "datas" => $data,
                "message" => $message,
                "logins" => $count,
            ];
            // dd($data_box);
            return redirect()->action([AdminController::class, 'index'])->with('data_box', $data_box);

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
                $message = sprintf("Your system number is SK-%s-%d", $lab->lab_code, $data['systemNumber']);
                $count = Student::where('isLoggedIn', 1)->count();

                $data_box = [
                    "datas" => $data,
                    "message" => $message,
                    "logins" => $count,
                ];

                return redirect()->action([AdminController::class, 'index'])->with('data_box', $data_box);
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

        $message = sprintf("%s has successfully Logged out ! worked time %d minutes", $main->name, $timeDifference);

        $count = Student::where('isLoggedIn', 1)->count();
        $data_box = [
            "datas" => $data,
            "message" => $message,
            "logins" => $count,
        ];

        return redirect()->action([AdminController::class, 'index'])->with('data_box', $data_box);

    }

    public function generateSystemNumber()
    {
        return rand(1, 66); // Assuming system numbers are within 1 to 60 range
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
