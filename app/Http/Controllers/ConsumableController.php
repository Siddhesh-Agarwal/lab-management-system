<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use App\Models\Labmove_table;
use App\Models\Temp;
use Illuminate\Http\Request;
use App\Models\Lab_Table;
class ConsumableController extends Controller
{
    public function index(){
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $data = Consumable::all();
        return view('consumables.list', ['consumables' => $data,'totalDeviceCount'=>$totalDeviceCount,'totalTempCount'=>$totalTempCount]);
    }

    public function edit($id){
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $labs = Lab_Table::get();
        $data = Consumable::where('id', '=', $id)->first();
        return view('consumables.editlist',['totalDeviceCount'=>$totalDeviceCount,'totalTempCount'=>$totalTempCount,'data'=>$data,'labs'=>$labs]);
    }
    public function add(){
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $labs = Lab_Table::get();
       
        return view('consumables.addlist',['totalDeviceCount'=>$totalDeviceCount,'totalTempCount'=>$totalTempCount,'labs'=>$labs]);
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $device_name = $request->device_name;
            $serial_number = $request->serial_number;
            $count = $request->count;
            $lab_name = $request->lab_name;

            Consumable::where('id', '=', $id)->update([
                'device_name' => $device_name,
                'serial_number' => $serial_number,
                'count' => $count,
                'labname' => $lab_name,
                
            ]);

            return redirect()->route('superadmin.list.consumables')->with('success', 'Consumables Updated successfully !');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.list.consumables')->with('error', 'Something went wrong !');
        }
    }
    public function save(Request $request)
    {
        try {
            $device_name = $request->device_name;
            $serial_number = $request->serial_number;
    
            $count = $request->count;

            $lab_name = $request->lab_name;

            $dev = new Consumable();
            $dev->device_name = $device_name;
            $dev->serial_number = $serial_number;
            $dev->count = $count;
            $dev->labname = $lab_name;

            $dev->save();

            return redirect()->route('superadmin.list.consumables')->with(['success' => 'Consumables added successfully !']);
        } catch (\Exception $e) {
            return redirect()->route('superadmin.list.consumables')->with(['error' => 'Something went wrong !']);
        }
    }

    public function delete($id)
    {
        try {
            $data = Consumable::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Consumables deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }

    public function indexadmin($lab_name)
    {
        $LabNames = Lab_Table::get();
        $data = Consumable::where('labname', '=', $lab_name)->get();
        return view('consumables.listadmin', ['data' => $data, 'labname' => $lab_name, 'labNames' => $LabNames]);
    }

}
