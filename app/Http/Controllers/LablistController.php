<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lablist;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Temp;
use Illuminate\Http\Request;

class LablistController extends Controller
{
    public function index()
    {
        $data = Lablist::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('lablist.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }

    public function indexa($lab_name)
    {
        $labNames = Lab_Table::get();
        $data = Lablist::where('lab_name', '=', $lab_name)->get();
        return view('lablistadmin.list', ['data' => $data, 'lab_name' => $lab_name, 'labNames' => $labNames]);
    }

    public function add()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        return view('lablist.addlist', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function adda()
    {
        $labNames = Lab_Table::get();
        return view('lablistadmin.addlist', ['labNames' => $labNames]);
    }

    public function save(Request $request)
    {
        try {
            $device_name = $request->device_name;
            $spec = $request->spec;
            $system_number = $request->system_number;
            $desc = $request->desc;

            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new Lablist();
            $dev->device_name = $device_name;
            $dev->spec = $spec;
            $dev->system_number = $system_number;
            $dev->desc = $desc;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;
            $dev->save();

            return redirect()->route('superadmin.lablists')->with(['success' => 'Device Added successfully!']);
        } catch (\Exception $e) {
            return redirect()->route('superadmin.lablists')->with(['error' => $e->getMessage()]);
        }
    }

    public function savea(Request $request)
    {
        try {
            $device_name = $request->device_name;
            $spec = $request->spec;
            $system_number = $request->system_number;
            $desc = $request->desc;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new Lablist();
            $dev->device_name = $device_name;
            $dev->spec = $spec;
            $dev->system_number = $system_number;
            $dev->desc = $desc;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;
            $dev->save();

            return redirect()->route('admin.lablist', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with(['success', 'Device Added successfully!']);
        } catch (\Exception $e) {
            return redirect()->route('admin.lablist', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with(['error', 'Something went wrong']);
        }
    }

    public function edit($id)
    {
        $data = Lablist::where('id', '=', $id)->first();
        $totalTempCount = Temp::count();
        $totalDeviceCount = Labmove_table::count();
        $labs = Lab_Table::get();
        return view('lablist.editlist', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }
    public function searchlab(Request $request)
    {
        $labName = urldecode($request->input('lab_name'));
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $data = Lablist::where('lab_name', 'like', "%$labName%")->get();
        session(['search_flag' => true]);
        return view('lablist.list', ['lab_name' => $labName, 'data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
    public function edita($id)
    {
        $labNames = Lab_Table::get();
        $data = Lablist::where('id', '=', $id)->first();
        return view('lablistadmin.editlist', ['data' => $data, 'labNames' => $labNames]);
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $device_name = $request->device_name;
            $spec = $request->spec;
            $system_number = $request->system_number;
            $desc = $request->desc;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            Lablist::where('id', '=', $id)->update([
                'device_name' => $device_name,
                'spec' => $spec,
                'system_number' => $system_number,
                'desc' => $desc,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);

            return redirect()->route('superadmin.lablists')->with('success', 'Device Updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.lablists')->with('error', 'Something went wrong');
        }
    }

    public function updatea(Request $request)
    {
        try {
            $id = $request->id;
            $device_name = $request->device_name;
            $spec = $request->spec;
            $system_number = $request->system_number;
            $desc = $request->desc;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            Lablist::where('id', '=', $id)->update([
                'device_name' => $device_name,
                'spec' => $spec,
                'system_number' => $system_number,
                'desc' => $desc,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);

            return redirect()->route('admin.lablist', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('success', 'Device Updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.lablist', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('error', 'Something went wrong');
        }
    }
    public function getLabDetails($labname)
    {
        $devices = Lablist::where('lab_name', $labname)->get();
        return response()->json($devices);
    }

    public function showDevices(Request $request)
    {
        // Use the LabTable model to retrieve the lab based on labname
        $lab = Lablist::where('lab_name', urldecode($request->lab_name))->first();

        if (!$lab) {
            abort(404); // Handle the case where the lab is not found
        }

        // Use the relationship to get the devices for the specific lab
        $devices = $lab->labTable;
        // dd($lab);
        dd($lab);
        return view('lablistadmin.list', compact('lab_name', 'devices'));
    }
    public function delete($id)
    {
        try {
            $data = Lablist::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Device Deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
