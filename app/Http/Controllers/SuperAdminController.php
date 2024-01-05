<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Lablist;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Logs;
use App\Models\Temp;
use App\Models\User;
use App\Models\Warranty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class SuperAdminController extends Controller
{
    public function index()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $deviceCount = LabList::where('type', 'Desktop')->count();
        $laptopCount = LabList::where('type', 'Laptop')->count();
        $labCount = Lab_Table::count();
        $allData = Warranty::get();
        $LabNames = Lab_Table::get();
        $warranty = Warranty::count();
        $filteredData = $allData->filter(function ($warranty) {
            $created_at = Carbon::parse($warranty->created_at);
            $time_period = Carbon::parse($warranty->time_period);
            return $created_at->diffInMonths($time_period) < 6;
        });
        $admins = User::where('role', 'admin')->count();
        return view('superadmin.content', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'deviceCount' => $deviceCount, 'admins' => $admins, 'labcount' => $labCount, 'data' => $filteredData, 'warranty' => $warranty, 'laptop' => $laptopCount]);
    }

    public function simple_search()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('superadmin.simplesearch', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }

    public function advance_search()
    {
        return view('superadmin.advancesearch');
    }

    public function contact()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('superadmin.contact', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8|max:15',
                'labname' => 'required',
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'labname' => urldecode($request->labname),
            ];
            User::create($data);
            return redirect(route('superadmin.details'))->with('success', 'Successfully admin was added !');
        } catch (\Exception $e) {
            return redirect(route('superadmin.details'))->with('error', 'Something went wrong !');
        }
    }

    public function details()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $details = User::where('role', 'admin')->get();
        return view('superadmin.admin_details', ['details' => $details, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }

    public function add_admin()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        return view('superadmin.add_admin', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }
    public function delete_admin(Request $request)
    {
        User::destroy($request->id);
        return redirect()->route('superadmin.details')->with('success', 'Successfully admin was deleted !');
    }

    public function tables()
    {
        return view('superadmin.tables');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Successfully logged out !');
    }

    public function edit_admin(int $id)
    {
        $user = User::find($id);

        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();

        return view('superadmin.edit_admin', [urlencode('user') => $user, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs, 'password' => '']);
    }
    public function update_admin(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:4|max:15',
                'role' => 'required',
                'labname' => 'required',
            ]);
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'labname' => urldecode($request->labname),
            ]);
            return redirect()->route('superadmin.details')->with('success', 'Successfully admin was updated !');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.edit.admin', ['id' => $id])->with('error', 'Password should be minimum 4 - 15 characters long !');
        }
    }
    public function searchBySerial(Request $request)
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $searchTerm = $request->input('search_term');
        $results = Lab::where('serial_number', 'LIKE', '%' . $searchTerm . '%')->get();
        // dd($results);
        return view('superadmin.simplesearch', ['results' => $results, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
    public function searchByDevice(Request $request)
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $searchTerm = $request->input('search_termd');
        $resultd = Lab::where('device_name', 'LIKE', '%' . $searchTerm . '%')->get();
        // dd($resultd);
        return view('superadmin.simplesearch', ['resultd' => $resultd, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);

    }
    public function searchBySystem(Request $request)
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $searchTerm = $request->input('search_terms');
        $result = Lablist::where('system_number', 'LIKE', '%' . $searchTerm . '%')->get();
        // dd($result);
        return view('superadmin.simplesearch', ['result' => $result, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);

    }
    public function getLabDetails()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        // $data = Lab_Table::get();
        // $data = DB::table('lab__tables')
        // ->join('users', 'lab__tables.lab_name', '=', 'users.labname')
        // ->select('lab__tables.lab_name', 'users.name as admin_name','lab__tables.id')
        // ->get();
        $data = Lab_Table::all();
        // dd($data);
        return view('superadmin.labdetails', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
    public function searchlab(Request $request)
    {
        $labName = $request->input('lab_name');
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $data = DB::table('lab__tables')
            ->join('users', 'lab__tables.lab_name', '=', 'users.labname')
            ->select('lab__tables.lab_name', 'users.name as admin_name')
            ->where('lab__tables.lab_name', 'like', "%$labName%")
            ->get();
        session(['search_flag' => true]);
        return view('superadmin.labdetails', ['lab_name' => $labName, 'data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }

    public function addlab()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('superadmin.addlablist', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }

    public function savelab(Request $request)
    {
        try {
            $lab_name = $request->lab_name;
            $code = $request->code;
            $block = $request->block;
            $room = $request->room_number;
            $dep = $request->department;
            $dev = new Lab_Table();
            $dev->lab_name = $lab_name;
            $dev->lab_code = $code;
            $dev->block = $block;
            $dev->room_number = $room;
            $dev->department = $dep;
            $dev->save();
            // dd($dev);
            return redirect()->route('superadmin.listinglabs')->with('success', 'Successfully lab added !');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.listinglabs')->with('error', 'Something went wrong !');
        }
    }

    public function getSystemNumbers($lab)
    {
        $systemNumbers = Lablist::where('lab_name', $lab)->pluck('system_number');
        return response()->json($systemNumbers);
    }

    public function log_details()
    {
        $labNames = Lab_Table::get();
        $details = Logs::all();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('superadmin.log_details', ['details' => $details, 'labNames' => $labNames, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
}
