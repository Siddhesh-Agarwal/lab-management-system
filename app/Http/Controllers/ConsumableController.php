<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use Illuminate\Http\Request;

class ConsumableController extends Controller
{
    public function add_consumable(){

    }

    public function index(){

        $data = Consumable::all();
        return view('consumables.list', ['consumables' => $data]);
    }

}
