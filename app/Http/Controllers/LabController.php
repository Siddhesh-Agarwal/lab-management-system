<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Lablist;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Temp;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
class LabController extends Controller
{
    public function index($lab_name)
    {
        $LabNames=Lab_Table::get();
        $data = Lab::where('lab_name', '=', $lab_name)->get();
        return view('lab.list', ['data' => $data, 'lab_name' => $lab_name,'labNames'=>$LabNames]);
    }
    public function indexs()
    {
        $data = Lab::get();
        $totalTempCount=Temp::count();
        $totalDeviceCount = Labmove_table::count();
        return view('lab.listadmin', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount,'totalTempCount'=>$totalTempCount]);
    }
    public function add()
    {

        $labName = \Illuminate\Support\Facades\Auth::user()->labname;
        $labNames=Lab_Table::get();
        $systemNumbers = Lablist::where('lab_name', $labName)->pluck('system_number');
        return view('lab.addlist',['systemNumbers' => $systemNumbers,'labNames'=>$labNames]);
    }
    public function adds()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $labs=Lab_Table::get();
        return view('lab.addlistadmin', ['totalDeviceCount' => $totalDeviceCount,'totalTempCount'=>$totalTempCount,'labs'=>$labs]);
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
            return redirect()->route('admin.listdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with(['error' => $e->getMessage()]);
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

            return redirect()->route('superadmin.lablistdevices')->with('success', 'Device Added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.lablistdevices')->with('error', 'Something went wrong!');
        }

    }

    public function edit($id)
    {
        $labName = \Illuminate\Support\Facades\Auth::user()->labname;
        $labNames=Lab_Table::get();
        $systemNumbers = Lablist::where('lab_name', $labName)->pluck('system_number');
        $data = Lab::where('id', '=', $id)->first();
        return view('lab.editlist', ['data'=>$data,'labName'=>$labName,'labNames'=>$labNames,'systemNumbers'=>$systemNumbers]);
    }
    public function edits($id)
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $labs=Lab_Table::get();
        $data = Lab::where('id', '=', $id)->first();
        return view('lab.editlistadmin', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount,'totalTempCount'=>$totalTempCount,'labs'=>$labs]);
    }

    public function searchlab(Request $request)
    {
        $labName = urldecode($request->input('lab_name'));
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $data = Lab::where('lab_name', 'like', "%$labName%")->get();
        session(['search_flag' => true]);
        return view('lab.listadmin', ['lab_name' => $labName, 'data' => $data, 'totalDeviceCount' => $totalDeviceCount,'totalTempCount'=>$totalTempCount]);
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
    public function updates(Request $request)
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
            return redirect()->route('superadmin.lablistdevices')->with('success', 'Device Updated successfully!');
        }
        catch(\Exception $e){
            return redirect()->route('superadmin.lablistdevices')->with('error', 'Something went wrong!');
        }
    }
    public function movetotemp($id)
    {
        $labNames=Lab_Table::get();
        $data = Lab::where('id', '=', $id)->first();
        return view('lab.scraplist',['data'=>$data,'labNames'=>$labNames]);
    }

    public function moveToScraps(Request $request)
    {
        try{
        $id = $request->id;
        $countToMove = $request->count;
        $descNew=$request->desc;
        $lab = Lab::findOrFail($id);
    
        if ($countToMove <= 0 || $countToMove > $lab->count) {
           
        }
    
        
        $existingScrap = Temp::where('serial_number', $lab->serial_number)->first();
    
        if ($existingScrap) {
            
            $existingScrap->count += $countToMove;
            $existingScrap->desc=$descNew;
            $existingScrap->save();
        } else {
            
            $scrap = new Temp([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $countToMove,
                'desc' => $descNew,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
            ]);
            $scrap->save();
        }
    
       
        $lab->count -= $countToMove;
        
        if ($lab->count <= 0) {
            $lab->delete();
        } else {
            $lab->save();
        }
    
        // Toastr::success('Device Moved successfully!', 'Success');
        return redirect()->route('admin.listdevice', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('success', 'Device Moved successfully!');
    }
    catch(\Exception $e){
        return redirect()->route('admin.listdevice', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('error', 'Something went wrong!');
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
