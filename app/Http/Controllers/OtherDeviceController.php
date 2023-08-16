<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\OtherDevice;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class OtherDeviceController extends Controller
{
    public function index()
    {
        $data = OtherDevice::get();
        $totalDeviceCount = Labmove_table::count();
        return view('otherdevices.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }

    public function indexa($lab_name)
    {
        // $data = OtherDevice::get();
        $data = OtherDevice::where('lab_name', '=', $lab_name)->get();
        return view('otherdevicesadmin.list', compact(('data')));
    }

    public function add()
    {
        $data = OtherDevice::get();
        $totalDeviceCount = Labmove_table::count();
        return view('otherdevices.addlist', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }

    public function adda()
    {
        return view('otherdevicesadmin.addlist');
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
            $dev = new OtherDevice();
            $dev->network_switches = $network_switches;
            $dev->ups_load = $ups_load;
            $dev->ac_load = $ac_load;
            $dev->wifi_access_points = $wifi_access_points;
            $dev->lab_name = $lab_name;
            $dev->lab_id = $lab_id;
            $dev->save();

            return redirect()->back()->with('notification', 'success');
        } catch (\Exception $e) {
            return redirect()->back()->with('notification', $e->getMessage());
        }

        // $data=array('device_name'=>$name,'serial_number'=>$serial_number,'system_model_number'=>$system_model_number,'count'=>$count,'lab_name'=>$lab_name);

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
            return redirect()->back()->with('notification', 'success');
        } catch (\Exception $e) {
            return redirect()->back()->with('notification', 'Error');

        }
        // $data=array('device_name'=>$name,'serial_number'=>$serial_number,'system_model_number'=>$system_model_number,'count'=>$count,'lab_name'=>$lab_name);
    }
    public function edit($id)
    {
        $datas = OtherDevice::get();
        $totalDeviceCount = Labmove_table::count();
        $data = OtherDevice::where('id', '=', $id)->first();
        return view('otherdevices.editlist', ['data' => $data, 'datas' => $datas, 'totalDeviceCount' => $totalDeviceCount]);
    }

    public function edita($id)
    {
        $data = OtherDevice::where('id', '=', $id)->first();
        return view('otherdevicesadmin.editlist', compact('data'));
    }

    public function update(Request $request)
    {
        try{
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

            return redirect()->back()->with('notification', 'success-device-update');
        }
        catch(\Exception $e){
            return redirect()->back()->with('notification', 'error-device-update');
        }
    }

    public function updatea(Request $request)
    {
        try{
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
    
            Toastr::success('Device Updated successfully!', 'Success');
            return redirect()->route('admin.otherdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'success update');
        }
        catch(\Exception $e){
            return redirect()->route('admin.otherdevice', ['lab_name' => \Illuminate\Support\Facades\Auth::user()->labname])->with('notification', 'error');
        }
    }
    public function searchlab(Request $request)
    {
        $labName = urldecode($request->input('lab_name'));
        $totalDeviceCount = Labmove_table::count();
        $data = OtherDevice::where('lab_name', 'like', "%$labName%")->get();
        session(['search_flag' => true]);
        return view('otherdevices.list', ['lab_name' => $labName, 'data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
        // return view('lablist.list', compact('data', 'labName', 'totalDeviceCount'));
    }
    public function delete($id)
    {
        try{
            $data = OtherDevice::find($id);
            $data->delete();
            return redirect()->back()->with('notification', 'success delete');
        }
        catch(\Exception $e){
            return redirect()->back()->with('notification', 'error');
        }
    }
}
