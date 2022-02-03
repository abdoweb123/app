<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function admin_login(){

        return view('adminLogin');
    }


    public function admin_register(){

        return view('admin_register');
    }


    public function dash(){

        return view('dash');
    }


    public function log_admin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){

            return redirect()->intended('dash');
        }
        return back()->withInput($request->only('email'));
    }



    public function register_admin(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6'
        ]);

        $register = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),

        ]);

        return redirect()->route('admin.login');
    }


}
