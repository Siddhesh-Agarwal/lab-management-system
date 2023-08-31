<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Labmove_table;
use App\Models\Manitenance;
use App\Models\ManitenanceLogs;
use App\Models\Scrap;
use App\Models\Temp;

class TempController extends Controller
{
    public function moveToScraps($id)
    {
        try{
        $lab = Temp::findOrFail($id);
        $existingLab = Scrap::where('serial_number', $lab->serial_number)->first();
        if ($existingLab) {
            $existingLab->count += $lab->count;
            $existingLab->save();
        } else {
            $scrap = new Scrap([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $lab->count,
                'desc' => $lab->desc,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
            ]);
            $scrap->save();
        }
        $lab->delete();
      
        return redirect()->back()->with('success', ' Data was moved to scrap successfully !');
    }
    catch(\Exception $e){
        return redirect()->back()->with('error', 'Something went wrong !');
    }
    }
    public function moveToService($id)
    {
        try{
        $lab = Temp::findOrFail($id);
        $existingLab = Manitenance::where('serial_number', $lab->serial_number)->first();
        if ($existingLab) {
            $existingLab->count += $lab->count;
            $existingLab->save();
        } else {
            $scrap = new Manitenance([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $lab->count,
                'desc' => $lab->desc,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
            ]);
            $scrap->save();
        }
        $lab->delete();
      
        return redirect()->back()->with('success', ' Data was moved to scrap successfully !');
    }
    catch(\Exception $e){
        return redirect()->back()->with('error', 'Something went wrong !');
    }
    }
    public function moveToBack($id)
    {
        try{
        $lab = Temp::findOrFail($id);
        $existingLab = Lab::where('serial_number', $lab->serial_number)->first();

        if ($existingLab) {

            $existingLab->count += $lab->count;
            $existingLab->save();
        } else {
            $newLab = new Lab([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $lab->count,
                'desc' => $lab->desc,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
            ]);
            $newLab->save();
        }

        $lab->delete();

      
        return redirect()->back()->with('success', 'Data was returned successfully !');
    }
    catch(\Exception $e){
        return redirect()->back()->with('error', 'Something went wrong !');
    }
    }
    public function returnToBack($id)
    {
        try{
        $lab = Manitenance::findOrFail($id);
        $existingLab = Lab::where('serial_number', $lab->serial_number)->first();

        if ($existingLab) {

            $existingLab->count += $lab->count;
            $existingLab->save();
        } else {
            $newLab = new Lab([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $lab->count,
                'desc' => $lab->desc,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
                
            ]);
            $newLab->save();
            $logs = new ManitenanceLogs([
                'device_name' => $lab->device_name,
                'serial_number' => $lab->serial_number,
                'system_model_number' => $lab->system_model_number,
                'count' => $lab->count,
                'desc' => $lab->desc,
                'lab_name' => $lab->lab_name,
                'lab_id' => $lab->lab_id,
                'moved_time'=>$lab->moved_time,
                'returned_time'=>$newLab->created_at,
                
            ]);
            $logs->save();
        }

        $lab->delete();

      
        return redirect()->back()->with('success', 'Data was returned successfully !');
    }
    catch(\Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    public function index()
    {
        $data = Temp::get();
        $scrapCount = Scrap::count();
        $totalTempCount = Temp::count();
        $totalDeviceCount = Labmove_table::count();
        return view('temps.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'scarpCount' => $scrapCount, 'totalTempCount' => $totalTempCount]);
    }

}
