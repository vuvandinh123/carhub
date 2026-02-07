<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Toyota',
                'country' => 'Japan',
                'founded_year' => '1937',
                'website' => 'https://www.toyota.com',
                'sort_order' => 1,
            ],
            [
                'name' => 'Honda',
                'country' => 'Japan',
                'founded_year' => '1948',
                'website' => 'https://www.honda.com',
                'sort_order' => 2,
            ],
            [
                'name' => 'BMW',
                'country' => 'Germany',
                'founded_year' => '1916',
                'website' => 'https://www.bmw.com',
                'sort_order' => 3,
            ],
            [
                'name' => 'Mercedes-Benz',
                'country' => 'Germany',
                'founded_year' => '1926',
                'website' => 'https://www.mercedes-benz.com',
                'sort_order' => 4,
            ],
            [
                'name' => 'Ford',
                'country' => 'USA',
                'founded_year' => '1903',
                'website' => 'https://www.ford.com',
                'sort_order' => 5,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => 'brands/' . Str::slug($brand['name']) . '.png',
                'description' => 'Thương hiệu xe ' . $brand['name'],
                'content' => 'Giới thiệu chi tiết về thương hiệu ' . $brand['name'],
                'country' => $brand['country'],
                'website' => $brand['website'],
                'founded_year' => $brand['founded_year'],
                'is_active' => true,
                'sort_order' => $brand['sort_order'],
                'meta_title' => $brand['name'] . ' - Thương hiệu xe',
                'meta_description' => 'Thông tin thương hiệu xe ' . $brand['name'],
                'meta_keywords' => strtolower($brand['name']) . ', xe ' . strtolower($brand['name']),
            ]);
        }
    }
}
