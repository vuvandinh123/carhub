<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parents = [
            [
                'name' => 'SUV',
                'children' => ['SUV 5 chỗ', 'SUV 7 chỗ', 'SUV hạng sang'],
                'sort_order' => 1,
            ],
            [
                'name' => 'Sedan',
                'children' => ['Sedan hạng B', 'Sedan hạng C', 'Sedan hạng D'],
                'sort_order' => 2,
            ],
            [
                'name' => 'Hatchback',
                'children' => ['Hatchback 3 cửa', 'Hatchback 5 cửa'],
                'sort_order' => 3,
            ],
            [
                'name' => 'MPV',
                'children' => ['MPV gia đình', 'MPV 7 chỗ', 'MPV hạng sang'],
                'sort_order' => 4,
            ],
            [
                'name' => 'Bán tải',
                'children' => ['Bán tải 1 cầu', 'Bán tải 2 cầu'],
                'sort_order' => 5,
            ],
        ];

        foreach ($parents as $parentData) {
            $parent = Category::create([
                'name' => $parentData['name'],
                'slug' => Str::slug($parentData['name']),
                'description' => 'Danh mục xe ' . $parentData['name'],
                'content' => 'Giới thiệu chi tiết về dòng xe ' . $parentData['name'],
                'type' => 'car',
                'thumbnail' => 'categories/' . Str::slug($parentData['name']) . '.jpg',
                'parent_id' => null,
                'is_active' => true,
                'sort_order' => $parentData['sort_order'],
                'meta_title' => $parentData['name'] . ' - Danh mục xe',
                'meta_description' => 'Các mẫu xe thuộc dòng ' . $parentData['name'],
                'meta_keywords' => strtolower($parentData['name']) . ', xe ' . strtolower($parentData['name']),
            ]);

            foreach ($parentData['children'] as $index => $childName) {
                Category::create([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'description' => 'Danh mục ' . $childName,
                    'content' => 'Giới thiệu chi tiết về ' . $childName,
                    'type' => 'car',
                    'thumbnail' => null,
                    'parent_id' => $parent->id,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'meta_title' => $childName,
                    'meta_description' => 'Thông tin ' . $childName,
                    'meta_keywords' => Str::slug($childName, ', '),
                ]);
            }
        }
    }
}
