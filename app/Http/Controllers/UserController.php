<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

        $cart = Cart::where('user_id', Auth::id())->pluck('quantity', 'product_id')->toArray();
        session(['cart' => $cart]);

        return redirect()->back()->withError('error_login', 'Email or password is incorrect');
    }
    public function register(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'repassword' => 'required|min:8|same:password', // Đảm bảo repassword giống password
        ]);

        $validator['password'] = Hash::make($validator['password']);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => $validator['password'],
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $cart = session('cart', []);
        foreach ($cart as $productId => $details) {
            Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $productId],
                ['quantity' => $details['quantity']]
            );
        }

        Auth::logout();
        return redirect('/');
    }


    public function index(){
        return view('admin.users.index');
    }
}
