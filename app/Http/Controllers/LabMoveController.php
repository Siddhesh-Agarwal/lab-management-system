<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lablist;
use App\Models\Lab_Table;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\Labmove_table;
use Brian2694\Toastr\Facades\Toastr;

class LabMoveController extends Controller
{
    //
    public function index()
    {
        $data = Labmove_table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('lablist.movelist', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }
    public function adda($id)
    {
        $data = Lablist::where('id', '=', $id)->first();
        return view('lablistadmin.movelist', compact('data'));
    }
    public function save(Request $request)
    {

        $device_name = $request->device_name;
        $spec = $request->spec;
        $system_number = $request->system_number;
        $desc = $request->desc;
        $source = urldecode($request->source);
        $destination = urldecode($request->destination);


        $lab = Lab_Table::where('lab_name', $source)->first();


        $lab_id = $lab ? $lab->id : null;

        $dev = new Labmove_table();
        $dev->device_name = $device_name;
        $dev->spec = $spec;
        $dev->system_number = $system_number;
        $dev->desc = $desc;
        $dev->source = $source;
        $dev->destination = $destination;
        $dev->lab_id = $lab_id;
        $dev->save();

        Lablist::where('system_number', $system_number)->delete();
        Toastr::success('Device Added successfully!', 'Success');
        // return redirect()->back()->with('notification', 'Device Added successfully!');
        // return redirect()->to('admin/lablist')->with('notification', 'Device Added successfully!');
        return redirect()->route('admin.lablist', ['lab_name'=>\Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'Device Added successfully!');


        // $data=array('device_name'=>$name,'serial_number'=>$serial_number,'system_model_number'=>$system_model_number,'count'=>$count,'lab_name'=>$lab_name);

    }
    public function moveToSource($id)
    {
        
        $lab = Labmove_table::findOrFail($id);

        $scrap = new Lablist([
            'device_name' => $lab->device_name,
            'spec' => $lab->spec,
            'system_number' => $lab->system_number,
            'desc' => $lab->desc,
            'lab_name' => $lab->source,
            'lab_id' => $lab->lab_id
        ]);
        $scrap->save();
        $lab->delete();
        Toastr::error('Request Denied successfully!', 'Error');
        return redirect()->back()->with('notification', ' Request Denied successfully!');
    }
    public function moveToDestination($id)
    {
        $lab = Labmove_table::findOrFail($id);
        $destinationLab = Lab_Table::where('lab_name', $lab->destination)->first();
        $labId = $destinationLab->id;
        $scrap = new Lablist([
            'device_name' => $lab->device_name,
            'spec' => $lab->spec,
            'system_number' => $lab->system_number,
            'desc' => $lab->desc,
            'lab_name' => $lab->destination,
            'lab_id' => $labId
        ]);
        $scrap->save();
        $lab->delete();
        Toastr::success('Request Accepted successfully!', 'Success');
        return redirect()->back()->with('notification', ' Request Accepted successfully!');
    }
}
