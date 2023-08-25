<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use App\Models\Labmove_table;
use App\Models\Temp;
use Illuminate\Http\Request;

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
        $data = Consumable::where('id', '=', $id)->first();
        return view('consumables.editlist',['totalDeviceCount'=>$totalDeviceCount,'totalTempCount'=>$totalTempCount,'data'=>$data]);
    }

}
