<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Toyota',
                'slug' => 'toyota',
                'logo' => 'brands/logos/toyota.png',
                'description' => 'Thương hiệu xe hơi hàng đầu Nhật Bản.',
                'content' => 'Toyota nổi tiếng với độ bền, tiết kiệm nhiên liệu và công nghệ tiên tiến.',
                'country' => 'jp',
                'website' => 'https://www.toyota-global.com',
                'founded_year' => '1937',
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'Toyota - Ô tô Nhật Bản',
                'meta_description' => 'Toyota - nhà sản xuất ô tô lớn nhất Nhật Bản.',
                'meta_keywords' => 'toyota, xe nhật, ô tô',
            ],
            [
                'name' => 'BMW',
                'slug' => 'bmw',
                'logo' => 'brands/logos/bmw.png',
                'description' => 'Thương hiệu xe sang đến từ Đức.',
                'content' => 'BMW nổi bật với thiết kế thể thao và trải nghiệm lái tuyệt vời.',
                'country' => 'de',
                'website' => 'https://www.bmw.com',
                'founded_year' => '1916',
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'BMW - Xe sang Đức',
                'meta_description' => 'BMW, thương hiệu xe sang nổi tiếng thế giới đến từ Đức.',
                'meta_keywords' => 'bmw, xe sang, xe đức',
            ],
            [
                'name' => 'Hyundai',
                'slug' => 'hyundai',
                'logo' => 'brands/logos/hyundai.png',
                'description' => 'Tập đoàn ô tô lớn của Hàn Quốc.',
                'content' => 'Hyundai mang đến nhiều mẫu xe giá cả hợp lý, thiết kế hiện đại.',
                'country' => 'kr',
                'website' => 'https://www.hyundai.com',
                'founded_year' => '1967',
                'is_active' => true,
                'sort_order' => 3,
                'meta_title' => 'Hyundai - Xe Hàn Quốc',
                'meta_description' => 'Hyundai - lựa chọn hàng đầu với thiết kế đẹp và giá cả phải chăng.',
                'meta_keywords' => 'hyundai, xe hàn, ô tô',
            ],
            [
                'name' => 'VinFast',
                'slug' => 'vinfast',
                'logo' => 'brands/logos/vinfast.png',
                'description' => 'Thương hiệu ô tô Việt Nam.',
                'content' => 'VinFast tiên phong trong lĩnh vực xe điện tại Việt Nam và quốc tế.',
                'country' => 'vn',
                'website' => 'https://vinfastauto.com',
                'founded_year' => '2017',
                'is_active' => true,
                'sort_order' => 4,
                'meta_title' => 'VinFast - Xe điện Việt Nam',
                'meta_description' => 'VinFast - hãng xe điện hàng đầu Việt Nam.',
                'meta_keywords' => 'vinfast, xe điện, ô tô việt nam',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['slug' => $brand['slug']], // tránh trùng lặp khi seed nhiều lần
                $brand
            );
        }
    }
}
