<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Lablist;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Temp;
use Illuminate\Http\Request;

class LabMoveController extends Controller
{
    public function index()
    {
        $data = Labmove_table::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('lablist.movelist', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
    public function adda($id)
    {
        $labNames = Lab_Table::get();
        $data = Lablist::where('id', '=', $id)->first();

        return view('lablistadmin.movelist', ['data' => $data, 'labNames' => $labNames]);
    }
    public function save(Request $request)
    {
        try{
            $id = $request->id;
            $device_name = $request->device_name;
            $spec = $request->spec;
            $system_number = $request->system_number;
            $desc = $request->desc;
            $source = $request->source;
            $destination = $request->destination;
    
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
            return redirect()->route('admin.lablist', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('success', 'Device moved successfully !');
        }
        catch(\Exception $e){
            return redirect()->route('admin.lablist', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('error', 'Something went wrong !');
        }
    }
    public function moveToSource($id)
    {
        try{
            $lab = Labmove_table::findOrFail($id);
            $scrap = new Lablist([
                'device_name' => $lab->device_name,
                'spec' => $lab->spec,
                'system_number' => $lab->system_number,
                'desc' => $lab->desc,
                'lab_name' => $lab->source,
                'lab_id' => $lab->lab_id,
            ]);
    
            $scrap->save();
            $lab->delete();

            return redirect()->back()->with('success', ' Request Denied successfully !');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
    public function moveToDestination($id)
    {
        try{
            $lab = Labmove_table::findOrFail($id);
            $destinationLab = Lab_Table::where('lab_name', $lab->destination)->first();
            $labId = $destinationLab->id;
            $scrap = new Lablist([
                'device_name' => $lab->device_name,
                'spec' => $lab->spec,
                'system_number' => $lab->system_number,
                'desc' => $lab->desc,
                'lab_name' => $lab->destination,
                'lab_id' => $labId,
            ]);
            Lab::where('system_model_number', $lab->system_number)
                ->update(['lab_name' => $lab->destination]);
            $scrap->save();
            $lab->delete();
            return redirect()->back()->with('success', ' Request Accepted successfully !');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
