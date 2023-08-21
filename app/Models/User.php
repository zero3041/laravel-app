<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'password'];
    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
}
