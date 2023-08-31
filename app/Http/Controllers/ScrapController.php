<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\Labmove_table;
use App\Models\Scrap;
use App\Models\Temp;

class ScrapController extends Controller
{
    public function index()
    {
        $data = Scrap::all();
        $totalDeviceCount = Labmove_table::count();
        $totalTempCount = Temp::count();
        return view('superadmin.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'totalTempCount' => $totalTempCount]);
    }
    public function delete($id)
    {
        try{
        Scrap::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Scrap data was deleted successfully !');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }
    public function deleteAll()
    {
        try{
            Scrap::truncate(); 
        
        return redirect()->back()->with('success', 'Scrap data was deleted successfully !');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong !');
        }
    }

    public function moveData($id)
    {
        // Find the row in the scraps table by its ID
        $data = Scrap::findOrFail($id);

        $labData = new Lab;
        $labData->device_name = $data->device_name;
        $labData->serial_number = $data->serial_number;
        $labData->system_model_number = $data->system_model_number;
        $labData->count = $data->count;
        $labData->desc = $data->desc;
        $labData->lab_name = $data->lab_name;
        // $labData->lab_id = $data->lab_id;
        $labData->save();

        // Delete the row from the scraps table
        $data->delete();

        // Redirect the user back to the scraps index page
        return redirect()->route('scrap.index');
    }
}
