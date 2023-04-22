<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.content');
    }

    public function simple_search()
    {
        return view('layouts.simplesearch');
    }

    public function advance_search()
    {
        return view('layouts.advancesearch');
    }

    public function contact()
    {
        return view('layouts.contact');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
