<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use App\Models\Lab;
use App\Http\Controllers\Controller;
use App\Models\Scrap;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Lab_Table;
use App\Models\Labmove_table;
class LabController extends Controller
{
    public function index($lab_name)
    {
        // $data = Lab::get();
        // return view('lab.list', compact('data'));
        $data = Lab::where('lab_name', '=', $lab_name)->get();
        // dd($data);
        return view('lab.list', ['data' => $data, 'lab_name' => $lab_name]);
    }
    public function indexs()
    {
        // dd($sample);
        $data = Lab::get();
        // $sample = Lab_Table::select('lab_name')->where('lab_name', 'like', 'Nicklaus Writh')->pluck();  
        // return view('lablist.list', ["datas" => $data, "labname" => $sample]);
        $totalDeviceCount = Labmove_table::count();
        return view('lab.listadmin', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }
    public function add()
    {
        return view('lab.addlist');
    }
    public function adds(){
        $totalDeviceCount = Labmove_table::count();
        return view('lab.addlistadmin',['totalDeviceCount'=>$totalDeviceCount]);
    }
    public function save(Request $request)
    {
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
        Toastr::success('Device Added successfully!', 'Success');
        return redirect()->route('admin.listdevice', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'Device Added successfully!');
    }
    public function saves(Request $request)
    {
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
        Toastr::success('Device Added successfully!', 'Success');
        return redirect()->route('superadmin.lablistdevices')->with('notification', 'Device Added successfully!');
    }

    public function edit($id)
    
    {
        // $totalDeviceCount = Labmove_table::count();
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
        return view('lab.listadmin', ['lab_name' => $labName, 'data' => $data,'totalDeviceCount'=>$totalDeviceCount]);
        // return view('lablist.list', compact('data', 'labName', 'totalDeviceCount'));
    }
    public function update(Request $request)
    {
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
        Toastr::success('Device Updated successfully!', 'Success');
        return redirect()->route('admin.listdevice', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'Device Updated successfully!');
    }

    public function moveToScraps($id)
    {
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
        Toastr::success('Device Moved successfully!', 'Success');
        return redirect()->back()->with('notification', 'Device Moved successfully!');
    }

    public function delete($id)
    {
        $data = Lab::find($id);
        $data->delete();
        Toastr::success('Device deleted successfully!', 'Success');
        return redirect()->back()->with('notification', 'Device deleted successfully!');
    }
}
