<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('roles')->insert([
            [
                'name' => 'daily',
                'display_name' => 'Đại lý cấp 1'
            ],
            [
                'name' => 'guest',
                'display_name' => 'Khách Hàng'
            ],
            [
                'name' => 'developer',
                'display_name' => 'Phát triển hệ thống'
            ],
            [
                'name' => 'content',
                'display_name' => 'Chỉnh sửa nội dung'
            ],
        ]);
    }
}
