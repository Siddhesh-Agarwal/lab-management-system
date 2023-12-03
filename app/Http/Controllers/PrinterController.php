<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab_Table;
use App\Models\Lab;
use App\Models\Printer;
use App\Models\Temp;
use App\Models\Labmove_table;

class PrinterController extends Controller
{
    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('printers.addlist', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }
    public function saves(Request $request)
    {
        try {
            $printer_model = $request->printer_model;
            $serial_number = $request->serial_number;
            $status = $request->status;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;

            $dev = new Printer();
            $dev->printer_model = $printer_model;
            $dev->serial_number = $serial_number;
            $dev->status = $status;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;

            $dev->save();

            return redirect()->route('superadmin.otherdevice')->with(['success' => 'Printer added successfully !']);
        } catch (\Exception $e) {

            return redirect()->route('superadmin.otherdevice')->with(['error' => 'Something went wrong !']);
        }
    }
}
