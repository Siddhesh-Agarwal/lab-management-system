<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Labmove_table;
use App\Models\Scrap;
use App\Models\Temp;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

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
        Toastr::success('Data Moved to scrap successfully!', 'Success');
        return redirect()->back()->with('success', ' Data moved to scrap successfully !');
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

        Toastr::success('Data returned successfully!', 'Success');
        return redirect()->back()->with('success', 'Data returned successfully !');
    }
    catch(\Exception $e){
        return redirect()->back()->with('error', 'Something went wrong !');
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Temp $temp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temp $temp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Temp $temp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temp $temp)
    {
        //
    }
}
