<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $cars = [
            [
                'title' => 'Toyota Vios 2024',
                'thumbnail' => 'cars/toyota-vios-2024.jpg',
                'brand_id' => 1,
                'category_id' => 1,
                'price' => 485000000,
                'year' => 2024,
                'quantity' => 5,
                'mileage' => 0,
                'engine' => '1.5L DOHC',
                'seats' => 5,
                'status' => 'available',
                'fuel' => 'xăng',
                'description' => 'Toyota Vios 2024 – sedan quốc dân, tiết kiệm nhiên liệu.',
                'content' => '<p>Toyota Vios 2024 sở hữu thiết kế hiện đại, bền bỉ...</p>',
                'created_by' => 1,
                'meta_title' => 'Toyota Vios 2024 giá tốt',
                'meta_description' => 'Toyota Vios 2024 chính hãng, giá ưu đãi',
                'meta_keywords' => 'toyota vios, sedan, xe gia đình',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Honda City 2023',
                'thumbnail' => 'cars/honda-city-2023.jpg',
                'brand_id' => 2,
                'category_id' => 1,
                'price' => 529000000,
                'year' => 2023,
                'quantity' => 3,
                'mileage' => 0,
                'engine' => '1.5L i-VTEC',
                'seats' => 5,
                'status' => 'available',
                'fuel' => 'xăng',
                'description' => 'Honda City 2023 – vận hành êm ái, thiết kế thể thao.',
                'content' => '<p>Honda City 2023 mang lại cảm giác lái vượt trội...</p>',
                'created_by' => 1,
                'meta_title' => 'Honda City 2023 chính hãng',
                'meta_description' => 'Honda City 2023 giá tốt, nhiều ưu đãi',
                'meta_keywords' => 'honda city, sedan hạng B',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Ford Ranger Wildtrak 2022 (Xe cũ)',
                'thumbnail' => 'cars/ford-ranger-2022.jpg',
                'brand_id' => 3,
                'category_id' => 2,
                'price' => 865000000,
                'year' => 2022,
                'quantity' => 1,
                'mileage' => 35000,
                'engine' => '2.0L Bi-Turbo',
                'seats' => 5,
                'status' => 'available',
                'fuel' => 'dầu',
                'description' => 'Ford Ranger Wildtrak 2022, xe cũ chất lượng cao.',
                'content' => '<p>Xe bán tải Ford Ranger Wildtrak 2022 đã qua sử dụng...</p>',
                'created_by' => 1,
                'meta_title' => 'Ford Ranger Wildtrak 2022 xe cũ',
                'meta_description' => 'Ford Ranger Wildtrak 2022 đã qua sử dụng, giá tốt',
                'meta_keywords' => 'ford ranger, bán tải, xe cũ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('cars')->insert($cars);
    }
}
