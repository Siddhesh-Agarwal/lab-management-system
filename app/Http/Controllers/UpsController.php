<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temp;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Upsload;

class UpsController extends Controller
{
    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('upsload.addlist', [ 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function saves(Request $request)
    {
        try {
            $ups_model = $request->ups_model;
            $ups_capacity = $request->ups_capacity;
            $no_batteries = $request->no_batteries;
            $status = $request->status;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new Upsload();
            $dev->ups_model = $ups_model;
            $dev->ups_capacity = $ups_capacity;
            $dev->no_batteries = $no_batteries;
            $dev->status=$status;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;

            $dev->save();

            return redirect()->route('superadmin.otherdevice')->with(['success' => 'UPS added successfully !']);
        } catch (\Exception $e) {
            
            return redirect()->route('superadmin.otherdevice')->with(['error' => 'Something went wrong !']);
        }
    }
}
