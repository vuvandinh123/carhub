<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarSpecificationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $specifications = [

            // ===== Toyota Vios (car_id = 1) =====
            [
                'car_id' => 1,
                'name' => 'Động cơ',
                'value' => '1.5L DOHC Dual VVT-i',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 1,
                'name' => 'Hộp số',
                'value' => 'CVT',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 1,
                'name' => 'Dẫn động',
                'value' => 'Cầu trước (FWD)',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 1,
                'name' => 'Mức tiêu thụ nhiên liệu',
                'value' => '5.7L/100km',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // ===== Honda City (car_id = 2) =====
            [
                'car_id' => 2,
                'name' => 'Động cơ',
                'value' => '1.5L i-VTEC',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 2,
                'name' => 'Hộp số',
                'value' => 'CVT',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 2,
                'name' => 'Công suất',
                'value' => '119 HP',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // ===== Ford Ranger (car_id = 3) =====
            [
                'car_id' => 3,
                'name' => 'Động cơ',
                'value' => '2.0L Bi-Turbo Diesel',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 3,
                'name' => 'Hộp số',
                'value' => '10AT',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'car_id' => 3,
                'name' => 'Hệ dẫn động',
                'value' => '4x4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('car_specifications')->insert($specifications);
    }
}
