<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin System',
                'username' => 'admin',
                'email' => 'vuvandinh203@gmail.com',
                'phone' => '0900000001',
                'avatar' => null,

                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => Carbon::now(),

                'password' => Hash::make('123456'),
                'role' => 'admin',

                'is_active' => true,
                'last_login_at' => Carbon::now(),
                'last_login_ip' => '127.0.0.1',

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyễn Văn Tư Vấn',
                'username' => 'consultant01',
                'email' => 'consultant@example.com',
                'phone' => '0900000002',
                'avatar' => null,

                'email_verified_at' => Carbon::now(),
                'phone_verified_at' => null,

                'password' => Hash::make('123456'),
                'role' => 'consultant',

                'is_active' => true,
                'last_login_at' => null,
                'last_login_ip' => null,

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khách Hàng Demo',
                'username' => null,
                'email' => 'customer@example.com',
                'phone' => '0900000003',
                'avatar' => null,

                'email_verified_at' => null,
                'phone_verified_at' => null,

                'password' => Hash::make('123456'),
                'role' => 'customer',

                'is_active' => true,
                'last_login_at' => null,
                'last_login_ip' => null,

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
