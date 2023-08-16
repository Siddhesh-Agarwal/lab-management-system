<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;


class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.content');
    }

    public function simple_search()
    {
        return view('superadmin.simplesearch');
    }

    public function advance_search()
    {
        return view('superadmin.advancesearch');
    }

    public function contact()
    {
        return view('superadmin.contact');
    }

    public function create(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8|max:15',
                'labname' => 'required',
            ]);
    
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'labname' => urldecode($request->labname),
            ];
    
            User::create($data);
            
            return redirect(route('superadmin.details'))->with('notification', 'success add');
        }
        catch(\Exception $e){
            return redirect(route('superadmin.details'))->with('notification', 'error');
        }
    }

    public function details()
    {

        $details = User::where('role', 'admin')->get();
        return view('superadmin.admin_details', compact(('details')));
    }

    public function add_admin()
    {
        return view('superadmin.add_admin');
    }
    public function delete_admin(Request $request)
    {
        User::destroy($request->id);
        return redirect()->route('superadmin.details')->with('notification', 'success delete');
    }

    public function tables()
    {
        return view('superadmin.tables');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function edit_admin(int $id)
    {
        $user = User::find($id);
        return view('superadmin.edit_admin', compact(urlencode('user')));
    }
    public function update_admin(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                // 'password' => 'required|min:8|max:15',
                'role' => 'required',
                'labname' => 'required',
            ]);
    
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                // 'password' => bcrypt($request->password),
                'role'  => $request->role,
                'labname' => urldecode($request->labname)
            ]);
    
            return redirect()->route('superadmin.details')->with('notification', 'success update');
        }
        catch(\Exception $e){
            return redirect()->route('superadmin.details')->with('notification', 'error');
        }
    }
}
