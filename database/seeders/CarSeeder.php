<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CarAttribute;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // người tạo mặc định
        if (!$user) {
            $this->command->warn("⚠️ Chưa có user nào trong bảng users.");
            return;
        }

        $brandToyota = Brand::firstOrCreate(['name' => 'Toyota'], ['slug' => 'toyota']);
        $brandHonda  = Brand::firstOrCreate(['name' => 'Honda'], ['slug' => 'honda']);
        $brandMazda  = Brand::firstOrCreate(['name' => 'Mazda'], ['slug' => 'mazda']);

        $categorySedan = Category::firstOrCreate(['slug' => 'sedan'], ['name' => 'Sedan']);
        $categorySuv   = Category::firstOrCreate(['slug' => 'suv'], ['name' => 'SUV']);

        // Lấy vài attribute mẫu
        $fuelPetrol = CarAttribute::firstOrCreate(['type' => 'fuel', 'name' => 'Xăng']);
        $fuelHybrid = CarAttribute::firstOrCreate(['type' => 'fuel', 'name' => 'Hybrid']);
        $bodySedan  = CarAttribute::firstOrCreate(['type' => 'body', 'name' => 'Sedan']);
        $bodySuv    = CarAttribute::firstOrCreate(['type' => 'body', 'name' => 'SUV']);
        $transAuto  = CarAttribute::firstOrCreate(['type' => 'transmission', 'name' => 'Tự động']);
        $transMan   = CarAttribute::firstOrCreate(['type' => 'transmission', 'name' => 'Số sàn']);
        $colorBlack = CarAttribute::firstOrCreate(['type' => 'color', 'name' => 'Đen']);
        $colorWhite = CarAttribute::firstOrCreate(['type' => 'color', 'name' => 'Trắng']);
        $originVN   = CarAttribute::firstOrCreate(['type' => 'origin', 'name' => 'Việt Nam']);
        $originJP   = CarAttribute::firstOrCreate(['type' => 'origin', 'name' => 'Nhật Bản']);

        $cars = [
            [
                'title' => 'Toyota Vios 2024',
                'thumbnail' => 'https://example.com/images/toyota-vios.jpg',
                'brand_id' => $brandToyota->id,
                'category_id' => $categorySedan->id,
                'price' => 560_000_000,
                'year' => 2024,
                'quantity' => 5,
                'mileage' => 0,
                'fuel_type_id' => $fuelPetrol->id,
                'body_type_id' => $bodySedan->id,
                'transmission_id' => $transAuto->id,
                'color_id' => $colorWhite->id,
                'origin_id' => $originVN->id,
                'engine' => '1.5L DOHC',
                'seats' => 5,
                'status' => 'available',
                'description' => 'Toyota Vios 2024 – mẫu sedan quốc dân, bền bỉ, tiết kiệm.',
                'content' => 'Chi tiết Toyota Vios 2024...',
                'created_by' => $user->id,
                'meta_title' => 'Toyota Vios 2024',
                'meta_description' => 'Mua Toyota Vios 2024 giá tốt',
                'meta_keywords' => 'toyota, vios, sedan, 2024',
            ],
            [
                'title' => 'Honda CR-V 2024',
                'thumbnail' => 'https://example.com/images/honda-crv.jpg',
                'brand_id' => $brandHonda->id,
                'category_id' => $categorySuv->id,
                'price' => 1_150_000_000,
                'year' => 2024,
                'quantity' => 3,
                'mileage' => 0,
                'fuel_type_id' => $fuelHybrid->id,
                'body_type_id' => $bodySuv->id,
                'transmission_id' => $transAuto->id,
                'color_id' => $colorBlack->id,
                'origin_id' => $originJP->id,
                'engine' => '2.0L Hybrid i-MMD',
                'seats' => 7,
                'status' => 'coming_soon',
                'description' => 'Honda CR-V 2024 – SUV gia đình, thiết kế mới, công nghệ hiện đại.',
                'content' => 'Chi tiết Honda CR-V 2024...',
                'created_by' => $user->id,
                'meta_title' => 'Honda CR-V 2024',
                'meta_description' => 'Honda CR-V 2024 bản mới nhất',
                'meta_keywords' => 'honda, crv, suv, hybrid',
            ],
            [
                'title' => 'Mazda 3 2023',
                'thumbnail' => 'https://example.com/images/mazda3.jpg',
                'brand_id' => $brandMazda->id,
                'category_id' => $categorySedan->id,
                'price' => 750_000_000,
                'year' => 2023,
                'quantity' => 2,
                'mileage' => 5000,
                'fuel_type_id' => $fuelPetrol->id,
                'body_type_id' => $bodySedan->id,
                'transmission_id' => $transMan->id,
                'color_id' => $colorRed = CarAttribute::firstOrCreate(['type' => 'color', 'name' => 'Đỏ'])->id,
                'origin_id' => $originJP->id,
                'engine' => '2.0L Skyactiv-G',
                'seats' => 5,
                'status' => 'sold',
                'description' => 'Mazda 3 2023 – sedan thể thao phong cách.',
                'content' => 'Chi tiết Mazda 3 2023...',
                'created_by' => $user->id,
                'meta_title' => 'Mazda 3 2023',
                'meta_description' => 'Mazda 3 2023 đã qua sử dụng',
                'meta_keywords' => 'mazda, sedan, 2023',
            ],
        ];

        foreach ($cars as $car) {
            Car::updateOrCreate(['title' => $car['title']], $car);
        }

        $this->command->info('✅ CarsTableSeeder đã tạo dữ liệu mẫu thành công!');
    }
}
