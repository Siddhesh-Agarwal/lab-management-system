<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\OtherDevice;
use App\Models\Temp;
use Illuminate\Http\Request;

class OtherDeviceController extends Controller
{
    public function index()
    {
        // $data = OtherDevice::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $LabNames = Lab_Table::get();
        return view('otherdevices.list', [ 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labs'=>$LabNames]);
    }

    public function indexa($lab_name)
    {
      
        $labNames = Lab_Table::get();
        $data = OtherDevice::where('lab_name', '=', $lab_name)->get();
        return view('otherdevicesadmin.list', ['data' => $data, 'labNames' => $labNames, 'lab_name' => $lab_name]);
    }

    public function add()
    {
        // $data = OtherDevice::get();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $totalDeviceCount = Labmove_table::count();
        return view('otherdevices.addlist', [ 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function adda()
    {
        $labNames = Lab_Table::get();
        return view('otherdevicesadmin.addlist', ['labNames' => $labNames]);
    }

    public function save(Request $request)
    {
        try {
            $network_switches = $request->network_switches;
            $ups_load = $request->ups_load;
            $ac_load = $request->ac_load;
            $wifi_access_points = $request->wifi_access_points;
            $lab_name = urldecode($request->lab_name);
            $lab = Lab_Table::where('lab_name', $lab_name)->first();

            $lab_id = $lab ? $lab->id : null;
            // dd($lab_id);

            $dev = new OtherDevice();
            $dev->network_switches = $network_switches;
            $dev->ups_load = $ups_load;
            $dev->ac_load = $ac_load;
            $dev->wifi_access_points = $wifi_access_points;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;
            $dev->save();

            return redirect()->route('superadmin.otherdevice')->with('success', 'Device Added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.otherdevice')->with('error', 'Something went wrong !');
        }

    }

    public function savea(Request $request)
    {

        try {
            $network_switches = $request->network_switches;
            $ups_load = $request->ups_load;
            $ac_load = $request->ac_load;
            $wifi_access_points = $request->wifi_access_points;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;
            $dev = new OtherDevice();
            $dev->network_switches = $network_switches;
            $dev->ups_load = $ups_load;
            $dev->ac_load = $ac_load;
            $dev->wifi_access_points = $wifi_access_points;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;
            $dev->save();
            return redirect()->back()->with('success', 'Device added successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }

    }
    public function edit($id)
    {
        $datas = OtherDevice::get();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $data = OtherDevice::where('id', '=', $id)->first();
        return view('otherdevices.editlist', ['data' => $data, 'datas' => $datas, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function edita($id)
    {
        $labNames = Lab_table::get();
        $data = OtherDevice::where('id', '=', $id)->first();
        return view('otherdevicesadmin.editlist', ['data' => $data, 'labNames' => $labNames]);
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $network_switches = $request->network_switches;
            $ups_load = $request->ups_load;
            $ac_load = $request->ac_load;
            $wifi_access_points = $request->wifi_access_points;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;

            OtherDevice::where('id', '=', $id)->update([
                'network_switches' => $network_switches,
                'ups_load' => $ups_load,
                'ac_load' => $ac_load,
                'wifi_access_points' => $wifi_access_points,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);

            return redirect()->route('superadmin.otherdevice')->with('success', 'Device updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.otherdevice')->with('notification', 'Something went wrong !');
        }
    }

    public function updatea(Request $request)
    {
        try {
            $id = $request->id;
            $network_switches = $request->network_switches;
            $ups_load = $request->ups_load;
            $ac_load = $request->ac_load;
            $wifi_access_points = $request->wifi_access_points;
            $lab_name = urldecode($request->lab_name);

            $lab = Lab_Table::where('lab_name', $lab_name)->first();
            $lab_id = $lab ? $lab->id : null;

            OtherDevice::where('id', '=', $id)->update([
                'network_switches' => $network_switches,
                'ups_load' => $ups_load,
                'ac_load' => $ac_load,
                'wifi_access_points' => $wifi_access_points,
                'lab_name' => $lab_name,
                'lab_id' => $lab_id,
            ]);

            return redirect()->route('admin.otherdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('success', 'Device updated successfully !');
        } catch (\Exception $e) {
            return redirect()->route('admin.otherdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('error', 'Something went wrong !');
        }
    }
    public function searchlab(Request $request)
    {
        $labName = urldecode($request->input('lab_name'));
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $data = OtherDevice::where('lab_name', 'like', "%$labName%")->get();
        session(['search_flag' => true]);

        return view('otherdevices.list', ['lab_name' => $labName, 'data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
    public function delete($id)
    {
        try {
            $data = OtherDevice::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Device deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
