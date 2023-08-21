<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index(){
        $roles = $this->role->paginate(5);
        return view('admin.roles.index',compact('roles'));
    }

    public function create(){
        return view('admin.roles.add');
    }
}
