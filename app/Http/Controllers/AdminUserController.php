<?php

namespace App\Http\Controllers;

use App\Models\Role;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function NunoMaduro\Collision\Exceptions\getLine;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){
        $user = $this->user->paginate(5);
        return view('admin.users.index',compact('user'));
    }

    public function create(){
        $roles = Role::all();
        return view('admin.users.add',compact('roles'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $user = $this->user::create([
                'name' =>  $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            DD::commit();
            $user->roles()->attach($request->role_id);
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            \Log::error('Message :' . '--- ' . $exception.getLine());
        };
    }

    public function edit($id){
        $roles = Role::all();
        $users = $this->user->find($id);
        $roleOfUser = $users->roles();
        return view('admin.users.edit',compact('roles','users','roleOfUser'));
    }

    public function update($id, Request $request){
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' =>  $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            DB::commit();
            $user->roles()->sync($request->role_id);
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            \Log::error('Message :' . '--- ' . $exception.getLine());
        };
    }

    public function delete($id){
        $users = $this->user->find($id);
        $users->delete();
        return redirect()->route('users.index');
    }
}
