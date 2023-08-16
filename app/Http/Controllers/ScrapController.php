<?php

namespace App\Http\Controllers;

use App\Models\Labmove_table;
use App\Models\Scrap;
use App\Http\Controllers\Controller;
use App\Models\Lab;
use Brian2694\Toastr\Facades\Toastr;

class ScrapController extends Controller
{
    public function index()
    {
        $data = Scrap::all();
        $totalDeviceCount=Labmove_table::count();
        return view('superadmin.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount]);
    }
    public function delete($id)
    {
        Scrap::where('id', '=', $id)->delete();
        +Toastr::success('Scrap data deleted successfully!', 'Success');
        return redirect()->back()->with('notification', 'Scrap data deleted successfully!');
    }

    public function moveData($id)
    {
        // Find the row in the scraps table by its ID
        $data = Scrap::findOrFail($id);

        // Create a new row in the labs table with the same data as the row from the scraps table
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
