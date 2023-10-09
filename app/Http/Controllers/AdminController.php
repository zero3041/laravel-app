<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    // Các hàm khác như loginAdmin, registerAdmin vẫn được giữ nguyên.

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $token = $this->adminService->login($email, $password);

        if ($token) {
            return response()->json(['status' => true, 'token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            // Validation rules
        ]);

        $this->adminService->register($data);

        return redirect()->route('logins.login')->with('success', 'Registration successful! Please login');
    }

    public function logout()
    {
        $this->adminService->logout();
        return redirect('/admins/login');
    }
}
