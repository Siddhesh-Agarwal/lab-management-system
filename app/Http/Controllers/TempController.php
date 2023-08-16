<?php

namespace App\Http\Controllers;

use App\Models\Labmove_table;
use App\Models\Scrap;
use App\Models\Temp;
use App\Http\Controllers\Controller;
use App\Models\Lab;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class TempController extends Controller
{
    public function moveToScraps($id)
    {
        $lab = Temp::findOrFail($id);
        $scrap = new Scrap([
            'device_name' => $lab->device_name,
            'serial_number' => $lab->serial_number,
            'system_model_number' => $lab->system_model_number,
            'count' => $lab->count,
            'desc' => $lab->desc,
            'lab_name' => $lab->lab_name,
            'lab_id'=>$lab->lab_id
        ]);
        $scrap->save();
        $lab->delete();
        Toastr::success('Data Moved successfully!', 'Success');
        return redirect()->back()->with('notification', ' Data Moved successfully!');
    }
    public function moveToBack($id)
    {
        $lab = Temp::findOrFail($id);
        $scrap = new Lab([
            'device_name' => $lab->device_name,
            'serial_number' => $lab->serial_number,
            'system_model_number' => $lab->system_model_number,
            'count' => $lab->count,
            'desc' => $lab->desc,
            'lab_name' => $lab->lab_name,
            'lab_id'=>$lab->lab_id
        ]);
        $scrap->save();
        $lab->delete();
        Toastr::success('Data returned successfully!', 'Success');
        return redirect()->back()->with('notification', 'Data returned successfully!');
    }

    public function index()
    {
        $data = Temp::get();
        $totalDeviceCount = Labmove_table::count();
        return view('temps.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
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