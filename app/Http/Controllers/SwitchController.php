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
    public function index()
    {
        $data = NetworkSwitch::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('networkswitch.list', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labs'=>$LabNames]);
    }
    public function indexa(Request $request)
    {
        $lab_name = $request->lab_name;
        $data = NetworkSwitch::where('lab_name', '=', $lab_name)->get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('otherdevicesadmin.networkSwitch', ['data'=>$data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labNames'=>$LabNames]);
    }

    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('networkswitch.addlist', ['totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }
    public function edit($id)
    {
        $datas = NetworkSwitch::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $data = NetworkSwitch::where('id', '=', $id)->first();
        return view('networkswitch.editlist', ['data' => $data, 'datas' => $datas, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
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
    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $switch_model = $request->switch_model;
            $serial_number = $request->serial_number;
            $status=$request->status;
            $lab_name = urldecode($request->lab_name);
            
            // dd($id);
            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;

            NetworkSwitch::where('id', '=', $id)->update([
                'switch_model' => $switch_model,
                'serial_number' => $serial_number,
                'status'=>$status,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);
            return redirect()->route('superadmin.switch')->with('success', 'Switch updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.switch')->with('notification', 'Something went wrong !');
        }
    }

    public function delete($id)
    {
        try {
            $data = NetworkSwitch::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Switch deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
