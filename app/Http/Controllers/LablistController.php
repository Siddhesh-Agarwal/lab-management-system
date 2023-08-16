<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lablist;
use App\Models\Labmove_table;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Lab_Table;

class LablistController extends Controller
{
    //
    public function index()
    {
        // dd($sample);
        $data = Lablist::get();
        // $sample = Lab_Table::select('lab_name')->where('lab_name', 'like', 'Nicklaus Writh')->pluck();  
        // return view('lablist.list', ["datas" => $data, "labname" => $sample]);
        $totalDeviceCount = Labmove_table::count();
        return view('lablist.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }

    public function indexa($lab_name)
    {
        $data = Lablist::where('lab_name', '=', $lab_name)->get();
        // dd($data);
        return view('lablistadmin.list', ['data' => $data, 'lab_name' => $lab_name]);
    }

    public function add()

    {
        $totalDeviceCount = Labmove_table::count();
        return view('lablist.addlist',['totalDeviceCount' => $totalDeviceCount]);
    }

    public function adda()
    {
        return view('lablistadmin.addlist');
    }

    public function save(Request $request)
    {

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
        // Toastr::success('Device Added successfully!', 'Success');
        return redirect()->back()->with('notification', 'success');


        // $data=array('device_name'=>$name,'serial_number'=>$serial_number,'system_model_number'=>$system_model_number,'count'=>$count,'lab_name'=>$lab_name);

    }

    public function savea(Request $request)
    {

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
        Toastr::success('Device Added successfully!', 'Success');
        return redirect()->route('admin.lablist', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'Device Added successfully!');


        // $data=array('device_name'=>$name,'serial_number'=>$serial_number,'system_model_number'=>$system_model_number,'count'=>$count,'lab_name'=>$lab_name);

    }
   
    public function edit($id)
    {
        $data = Lablist::where('id', '=', $id)->first();
        $totalDeviceCount = Labmove_table::count();
        return view('lablist.editlist', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }
    public function searchlab(Request $request)
    {
        $labName = urldecode($request->input('lab_name'));
        $totalDeviceCount = Labmove_table::count();
        $data = Lablist::where('lab_name', 'like', "%$labName%")->get();
        session(['search_flag' => true]);
        return view('lablist.list', ['lab_name' => $labName, 'data' => $data,'totalDeviceCount'=>$totalDeviceCount]);
        // return view('lablist.list', compact('data', 'labName', 'totalDeviceCount'));
    }
    public function edita($id)
    {
        $data = Lablist::where('id', '=', $id)->first();
        return view('lablistadmin.editlist', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $device_name = $request->device_name;
        $spec = $request->spec;
        $system_number = $request->system_number;
        $desc = $request->desc;
        $lab_name = urldecode($request->lab_name);


        $lab = Lab_Table::where('lab_name', $lab_name)->first();


        $lab_id = $lab ? $lab->id : null;

        // $dev = Lablist::find($id);
        // $dev->device_name = $device_name;
        // $dev->spec = $spec;
        // $dev->system_number = $system_number;
        // $dev->desc = $desc;

        // $dev->save();
        //
        Lablist::where('id', '=', $id)->update([
            'device_name' => $device_name,
            'spec' => $spec,
            'system_number' => $system_number,
            'desc' => $desc,
            'lab_name' => $lab_name,
            'lab_id' => $lab_id,
        ]);
        Toastr::success('Device  Updated successfully!', 'Success');
        return redirect()->back()->with('notification', 'Device Updated successfully!');
    }

    public function updatea(Request $request)
    {
        try{
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
            
            return redirect()->route('admin.lablist', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'success update');
        }
        catch(\Exception $e){
            return redirect()->route('admin.lablist', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'error');
        }
    }
    public function getLabDetails($labname)
    {
        $devices = Lablist::where('lab_name', $labname)->get();
        return response()->json($devices);
    }
    // public function showDevices($lab_name)
    // {

    //     $lab = LabList::where('lab_name', $lab_name)->first();

    //     if (!$lab) {
    //         abort(404); 
    //     }

    //     $devices = $lab->devices;

    //     return view('lablistadmin.list', compact('lab_name', 'devices'));
    // }
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
        try{
            $data = Lablist::find($id);
            $data->delete();
            return redirect()->back()->with('notification', 'success delete');
        }
        catch(\Exception $e){
            return redirect()->back()->with('notification', 'error');
        }
    }
}
