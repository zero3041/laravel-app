<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function findByEmail($email)
    {
        return Admin::where('email', $email)->first();
    }

    public function create($data)
    {
        return Admin::create($data);
    }
}
