<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function loginAdmin(){
        return view('admin.login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admins');
        }
        return redirect()->back()->withError('error_login', 'Email or password is incorrect');
    }

    public function registerAdmin(){
        return view('admin.register');
    }

    public function register(Request $request){
//        dd($request);
        $validator = $request->validate([
            'email' => 'required|email|unique:admins,email',
            'username' => 'required|unique:admins,username',
            'password' => 'required|min:6|max:32',
            're-password' => 'required|min:6|max:32|same:password'
        ],[
            're-password.same' => 'Xác nhận mật khẩu không khớp'
        ]);
        $validator['password'] = hash::make($validator['password']);

        Admin::create($validator);

        return redirect()->route('logins.login')->with('success','Registration successful! Please login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admins/login');
    }
}
