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

    public function index()
    {
        $data = Printer::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('printers.list', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labs'=>$LabNames]);
    }
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

    public function edit($id)
    {
        $datas = Printer::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $data = Printer::where('id', '=', $id)->first();
        return view('printers.editlist', ['data' => $data, 'datas' => $datas, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $printer_model = $request->printer_model;
            $serial_number = $request->serial_number;
            $status=$request->status;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;

            Printer::where('id', '=', $id)->update([
                'printer_model' => $printer_model,
                'serial_number' => $serial_number,
                'status'=>$status,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);

            return redirect()->route('superadmin.printer')->with('success', 'Printer updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.printer')->with('notification', 'Something went wrong !');
        }
    }

    public function delete($id)
    {
        try {
            $data = Printer::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Printer deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
