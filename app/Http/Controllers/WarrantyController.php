<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lablist;
use App\Models\Labmove_table;
use App\Models\Lab_Table;
use App\Models\Temp;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Carbon\Carbon;
class WarrantyController extends Controller
{
     public function index(){
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
        $data=Warranty::get();
        $LabNames = Lab_Table::get();
        foreach ($data as $warranty) {
            $warranty->time_period_diff = $this->calculateTimePeriod($warranty);
        }
        return view('warranty.list',['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount,'labs'=>$LabNames]);
     }

     
    public function filter()
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $allData = Warranty::get(); // Get all warranties

        $LabNames = Lab_Table::get();

        // Filter warranties with time period less than 6 months
        $filteredData = $allData->filter(function ($warranty) {
            $created_at = Carbon::parse($warranty->created_at);
            $time_period = Carbon::parse($warranty->time_period);
            return $created_at->diffInMonths($time_period) < 6;
        });

        return view('superadmin.content', [
            'data' => $filteredData,
            'totalDeviceCount' => $totalDeviceCount,
            'totalTempCount' => $totalTempCount,
            'labs' => $LabNames
        ]);
    }

     public function add()
     {
 
         $labName = \Illuminate\Support\Facades\Auth::user()->labname;
         $labNames = Lab_Table::get();
         $labs=Lab_Table::get();
         $totalDeviceCount = Labmove_table::count();
        $totalTempCount=Temp::count();
         $systemNumbers = Lablist::where('lab_name', $labName)->pluck('system_number');
         return view('warranty.addlist', ['systemNumbers' => $systemNumbers, 'labNames' => $labNames,'labs'=>$labs, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
     }

     public function save(Request $request)
    {
        try {

            $warranty_name = $request->warranty_name;
            $system_number = $request->system_number;
            $time_period = $request->time_period;
            $lab_name = $request->input('lab_name');

            $dev = new Warranty();
            $dev->warranty_name = $warranty_name;
            $dev->system_number = $system_number;
            $dev->labname = $lab_name;
            $dev->time_period = $time_period;
        

            $dev->save();

            return redirect()->route('superadmin.warranty')->with('success', 'Warranty Added successfully !');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.warranty')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        $labs = Lab_Table::get();
        $data = Warranty::where('id', '=', $id)->first();
        return view('warranty.editlist', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount, 'labs' => $labs]);
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $warranty_name = $request->warranty_name;
            $system_number = $request->system_number;
            $time_period = $request->time_period;
            $lab_name = $request->lab_name;

            Warranty::where('id', '=', $id)->update([
                'warranty_name' => $warranty_name,
                'system_number' => $system_number,
                'time_period' => $time_period,
                'labname' => $lab_name,
                
            ]);
            return redirect()->route('superadmin.warranty')->with('success', 'Warranty Updated successfully !');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.warranty')->with('error', 'Something went wrong !');
        }
    }

    public function calculateTimePeriod($warranty)
    {
        $created_at = Carbon::parse($warranty->created_at);
        $time_period = Carbon::parse($warranty->time_period);

        return $created_at->diffInDays($time_period);
    }
    public function delete($id)
    {
        try {
            $data =Warranty::find($id);
            $data->delete();
            return redirect()->back()->with('success', 'Warranty deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
}
