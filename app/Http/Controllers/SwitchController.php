<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NetworkSwitch;
use Illuminate\Http\Request;
use App\Models\Temp;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
class SwitchController extends Controller
{
    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('networkswitch.addlist', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }
    public function saves(Request $request)
    {
        try {
            $switch_model = $request->switch_model;
            $serial_number = $request->serial_number;
            $status = $request->status;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new NetworkSwitch();
            $dev->switch_model = $switch_model;
            $dev->serial_number = $serial_number;
            $dev->status = $status;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;

            $dev->save();

            return redirect()->route('superadmin.otherdevice')->with(['success' => 'Switch added successfully !']);
        } catch (\Exception $e) {

            return redirect()->route('superadmin.otherdevice')->with(['error' => 'Something went wrong !']);
        }
    }
}
