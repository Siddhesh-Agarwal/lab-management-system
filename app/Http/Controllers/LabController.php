<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Temp;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index($lab_name)
    {
        $data = Lab::where('lab_name', '=', $lab_name)->get();
        return view('lab.list', ['data' => $data, 'lab_name' => $lab_name]);
    }
    public function indexs()
    {
        $data = Lab::get();
        $totalDeviceCount = Labmove_table::count();
        return view('lab.listadmin', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }
    public function add()
    {
        return view('lab.addlist');
    }
    public function adds()
    {
        $totalDeviceCount = Labmove_table::count();
        return view('lab.addlistadmin', ['totalDeviceCount' => $totalDeviceCount]);
    }
    public function save(Request $request)
    {
        try {
            $device_name = $request->device_name;
            $serial_number = $request->serial_number;
            $system_model_number = $request->system_model_number;
            $count = $request->count;
            $desc = $request->desc;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new Lab();
            $dev->device_name = $device_name;
            $dev->serial_number = $serial_number;
            $dev->system_model_number = $system_model_number;
            $dev->count = $count;
            $dev->desc = $desc;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;

            $dev->save();

            return redirect()->route('admin.listdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with(['success' => 'Device Added successfully!']);
        } catch (\Exception $e) {
            return redirect()->route('admin.listdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with(['error' => 'Something went wrong!']);
        }
    }
    public function saves(Request $request)
    {
        try {

            $device_name = $request->device_name;
            $serial_number = $request->serial_number;
            $system_model_number = $request->system_model_number;
            $count = $request->count;
            $desc = $request->desc;
            $lab_name = $request->input('lab_name');

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new Lab();
            $dev->device_name = $device_name;
            $dev->serial_number = $serial_number;
            $dev->system_model_number = $system_model_number;
            $dev->count = $count;
            $dev->desc = $desc;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;

            $dev->save();

            return redirect()->route('superadmin.lablistdevices')->with('notification', 'Device Added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.lablistdevices')->with('error', 'Something went wrong!');
        }

    }

    public function edit($id)
    {
        $data = Lab::where('id', '=', $id)->first();
        return view('lab.editlist', compact('data'));
    }
    public function edits($id)
    {
        $totalDeviceCount = Labmove_table::count();
        $data = Lab::where('id', '=', $id)->first();
        return view('lab.editlistadmin', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }

    public function searchlab(Request $request)
    {
        $labName = urldecode($request->input('lab_name'));
        $totalDeviceCount = Labmove_table::count();
        $data = Lab::where('lab_name', 'like', "%$labName%")->get();
        session(['search_flag' => true]);
        return view('lab.listadmin', ['lab_name' => $labName, 'data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }
    public function update(Request $request)
    {
        try{
            $id = $request->id;
            $device_name = $request->device_name;
            $serial_number = $request->serial_number;
            $system_model_number = $request->system_model_number;
            $count = $request->count;
            $desc = $request->desc;
            $lab_name = urldecode($request->lab_name);
    
            $lab = Lab_Table::where('lab_name', $lab_name)->first();
    
            $lab_id = $lab ? $lab->id : null;
    
            Lab::where('id', '=', $id)->update([
                'device_name' => $device_name,
                'serial_number' => $serial_number,
                'system_model_number' => $system_model_number,
                'count' => $count,
                'desc' => $desc,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);
            return redirect()->route('admin.listdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('success', 'Device Updated successfully!');
        }
        catch(\Exception $e){
            return redirect()->route('admin.listdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('error', 'Something went wrong!');
        }
    }

    public function moveToScraps($id)
    {
        try{

            $lab = Lab::findOrFail($id);
            $scrap = new Temp([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $lab->count,
                'desc' => $lab->desc,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
            ]);
            $scrap->save();
            $lab->delete();
            return redirect()->back()->with('success', 'Device Moved successfully!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        try{
            $data = Lab::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Device deleted successfully!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
