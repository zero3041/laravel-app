<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\InputBag;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withError('error_login', 'Email or password is incorrect');
    }
    public function register(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        $validator['password'] = Hash::make($validator['password']);

        $user = User::create($validator);

        Auth::login($user);

        return redirect('/');
    }

    public function index(){
        return view('admin.users.index');
    }
}
