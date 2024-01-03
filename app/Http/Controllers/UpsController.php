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
    public function index()
    {
        $data = Upsload::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('upsload.list', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labs'=>$LabNames]);
    }
    public function indexa(Request $request)
    {
        $lab_name = $request->lab_name;
        $data = Upsload::where('lab_name', '=', $lab_name)->get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('otherdevicesadmin.ups', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labNames'=>$LabNames]);
    }
    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('upsload.addlist', [ 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function edit($id)
    {
        $datas = Upsload::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $data = Upsload::where('id', '=', $id)->first();
        return view('upsload.editlist', ['data' => $data, 'datas' => $datas, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
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

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $ups_model = $request->ups_model;
            $ups_capacity = $request->ups_capacity;
            $no_batteries=$request->no_batteries;
            $status=$request->status;
            $lab_name = urldecode($request->lab_name);
            
            // dd($id);
            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;

            Upsload::where('id', '=', $id)->update([
                'ups_model' => $ups_model,
                'ups_capacity' => $ups_capacity,
                'no_batteries'=>$no_batteries,
                'status'=>$status,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);
            return redirect()->route('superadmin.upsload')->with('success', 'Switch updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.upsload')->with('notification', 'Something went wrong !');
        }
    }

    public function delete($id)
    {
        try {
            $data = Upsload::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Ups deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
