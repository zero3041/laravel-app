<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    // Thêm vào để dùng soft delete

    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'slug'];

}
