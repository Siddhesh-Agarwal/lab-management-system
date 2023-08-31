<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Labmove_table;
use App\Models\Manitenance;
use App\Models\Scrap;
use App\Models\Temp;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function index(){
        $data=Manitenance::get();
        $scrapCount = Scrap::count();
        $totalTempCount = Temp::count();
        $totalDeviceCount = Labmove_table::count();
        return view('service.list', ['data' => $data, 'totalDeviceCount' => $totalDeviceCount, 'scarpCount' => $scrapCount, 'totalTempCount' => $totalTempCount]);
    }
}
