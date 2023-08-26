<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use App\Models\Labmove_table;
use App\Models\Temp;
use Illuminate\Http\Request;
use App\Models\Lab_Table;
class ConsumableController extends Controller
{
    public function add_consumable(){

    }

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
            return redirect()->route('superadmin.list.consumables')->with('success', 'Device Updated successfully !');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.list.consumables')->with('error', 'Something went wrong !');
        }
    }

}
