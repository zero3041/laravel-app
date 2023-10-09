<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login($email, $password)
    {
        $admin = $this->adminRepository->findByEmail($email);

        if ($admin && Hash::check($password, $admin->password)) {
            $token = $admin->createToken('MyApp')->accessToken;
            return $token;
        }

        return null;
    }

    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->adminRepository->create($data);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
    }
}
