<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(){
        $roles = $this->role->paginate(5);
        return view('admin.roles.index',compact('roles'));
    }

    public function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        return view('admin.roles.add',compact('permissionsParent'));
    }

    public function store(Request $request){
        $role = $this->role->create([
           'name' => $request->name,
           'display_name' => $request->display_name
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit($id){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        $role = Role::find($id);
        $permissionsCheck = $role->permissions;
        return view('admin.roles.edit',compact('permissionsParent','role','permissionsCheck'));
    }

    public function update(Request $request, $id){
         $this->role->find($id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role = Role::find($id);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function delete($id){
        $role = $this->role->find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
