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
    public function index()
    {
        $data = ACload::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('acload.list', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labs'=>$LabNames]);
    }
    public function indexa(Request $request)
    {
        $lab_name = $request->lab_name;
        $data = ACload::where('lab_name', '=', $lab_name)->get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('otherdevicesadmin.acLoad', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labNames'=>$LabNames]);
    }

    public function edit($id)
    {
        $datas = ACload::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $data = ACload::where('id', '=', $id)->first();
        return view('acload.editlist', ['data' => $data, 'datas' => $datas, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }
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

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $ac_model = $request->ac_model;
            $ac_capacity = $request->ac_capacity;
            $status=$request->status;
            $lab_name = urldecode($request->lab_name);
            
            // dd($id);
            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;

            ACload::where('id', '=', $id)->update([
                'ac_model' => $ac_model,
                'ac_capacity' => $ac_capacity,
                'status'=>$status,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);
            return redirect()->route('superadmin.acload')->with('success', 'Acload updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.acload')->with('notification', 'Something went wrong !');
        }
    }

    public function delete($id)
    {
        try {
            $data = ACload::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Ac deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
