<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('admin.reset-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        // Validate email
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Generate token
        $token = Str::random(60);

        // Store token in the password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Send reset password email
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->back()->with('status', 'Link đặt lại mật khẩu đã được gửi vào email của bạn!');
    }

    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')->where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset) {
            return redirect()->back()->with(['error' => 'Invalid token!']);
        }

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with(['error' => 'Email not found!']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/logins')->with(['message' => 'Password has been reset successfully!']);
    }

    public function showResetFormPass(Request $request, $token = null){
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }
}
