<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSpecificationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('car_specifications')->insert([
            // ===== Toyota Vios 2024 =====
            [
                'car_id' => 1,
                'name' => 'Dung tích động cơ',
                'value' => '1.5L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 1,
                'name' => 'Hộp số',
                'value' => 'CVT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 1,
                'name' => 'Dẫn động',
                'value' => 'Cầu trước (FWD)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 1,
                'name' => 'Mức tiêu thụ nhiên liệu',
                'value' => '5.8L/100km',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ===== Honda CR-V 2023 =====
            [
                'car_id' => 2,
                'name' => 'Dung tích động cơ',
                'value' => '1.5L Turbo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'name' => 'Hộp số',
                'value' => 'CVT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'name' => 'Số chỗ ngồi',
                'value' => '7 chỗ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'name' => 'Hệ dẫn động',
                'value' => 'AWD',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ===== VinFast VF 8 =====
            [
                'car_id' => 3,
                'name' => 'Loại động cơ',
                'value' => 'Động cơ điện',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 3,
                'name' => 'Công suất',
                'value' => '300 kW',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 3,
                'name' => 'Quãng đường tối đa',
                'value' => '~420 km/lần sạc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 3,
                'name' => 'Thời gian sạc nhanh',
                'value' => '30 phút (10–70%)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
