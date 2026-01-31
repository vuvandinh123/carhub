<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'title' => 'Toyota Vios 2024',
                'thumbnail' => 'cars/vios-2024.jpg',

                'brand_id' => 1,
                'category_id' => 1,

                'price' => 458000000,
                'year' => 2024,
                'quantity' => 5,
                'mileage' => 0,

                'engine' => '1.5L',
                'seats' => 5,
                'fuel' => 'Xăng',

                'status' => 'available',

                'description' => 'Toyota Vios 2024 – sedan quốc dân, tiết kiệm nhiên liệu.',
                'content' => 'Toyota Vios 2024 được trang bị động cơ 1.5L, thiết kế hiện đại, phù hợp cho gia đình và dịch vụ.',

                'created_by' => 1,

                'meta_title' => 'Toyota Vios 2024 giá tốt',
                'meta_description' => 'Toyota Vios 2024 – sedan bền bỉ, tiết kiệm, giá hợp lý.',
                'meta_keywords' => 'toyota vios 2024, sedan toyota',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Honda CR-V 2023',
                'thumbnail' => 'cars/honda-crv-2023.jpg',

                'brand_id' => 2,
                'category_id' => 2,

                'price' => 998000000,
                'year' => 2023,
                'quantity' => 2,
                'mileage' => 12000,

                'engine' => '1.5L Turbo',
                'seats' => 7,
                'fuel' => 'Xăng',

                'status' => 'available',

                'description' => 'Honda CR-V 2023 bản 7 chỗ, xe gia đình cao cấp.',
                'content' => 'Honda CR-V 2023 đã qua sử dụng, tình trạng tốt, đầy đủ tiện nghi an toàn.',

                'created_by' => 1,

                'meta_title' => 'Honda CR-V 2023 cũ',
                'meta_description' => 'Honda CR-V 2023 xe gia đình, rộng rãi, an toàn.',
                'meta_keywords' => 'honda cr-v 2023, suv honda',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'VinFast VF 8',
                'thumbnail' => 'cars/vf8.jpg',

                'brand_id' => 3,
                'category_id' => 2,

                'price' => 1120000000,
                'year' => 2024,
                'quantity' => 3,
                'mileage' => 0,

                'engine' => 'Điện 300kW',
                'seats' => 5,
                'fuel' => 'Điện',

                'status' => 'coming_soon',

                'description' => 'VinFast VF 8 – SUV điện thông minh.',
                'content' => 'VF 8 sở hữu thiết kế hiện đại, công nghệ tiên tiến, phù hợp xu hướng xe điện.',

                'created_by' => 1,

                'meta_title' => 'VinFast VF 8 SUV điện',
                'meta_description' => 'VinFast VF 8 – SUV điện cao cấp tại Việt Nam.',
                'meta_keywords' => 'vinfast vf8, xe điện vinfast',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
