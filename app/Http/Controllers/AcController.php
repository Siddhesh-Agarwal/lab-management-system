<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ACload;
use Illuminate\Http\Request;
use App\Models\Temp;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
class AcController extends Controller
{
    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('acload.addlist', [ 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function saves(Request $request)
    {
        try {
            $ac_model = $request->ac_model;
            $ac_capacity = $request->ac_capacity;
            $status = $request->status;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new ACload();
            $dev->ac_model = $ac_model;
            $dev->ac_capacity = $ac_capacity;
            $dev->status=$status;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;

            $dev->save();

            return redirect()->route('superadmin.otherdevice')->with(['success' => 'AC added successfully !']);
        } catch (\Exception $e) {
            
            return redirect()->route('superadmin.otherdevice')->with(['error' => 'Something went wrong !']);
        }
    }
}
