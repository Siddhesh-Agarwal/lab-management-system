<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.content');
    }

    public function tables()
    {
        return view('admin.tables');
    }

    public function add_device()
    {
        return view('layouts.add_device');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function simple_search()
    {
        return view('admin.simplesearch');
    }

    public function advance_search()
    {
        return view('admin.advancesearch');
    }

    public function contact()
    {
        return view('admin.contact');
    }
}
