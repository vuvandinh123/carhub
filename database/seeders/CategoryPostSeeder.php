<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\CategoryPost;

class CategoryPostSeeder extends Seeder
{
    public function run(): void
    {
        $parents = [
            [
                'name' => 'Tin tức',
                'children' => [
                    'Tin thị trường',
                    'Tin khuyến mãi',
                    'Tin công nghệ xe',
                ],
            ],
            [
                'name' => 'Đánh giá xe',
                'children' => [
                    'Đánh giá chi tiết',
                    'So sánh xe',
                ],
            ],
            [
                'name' => 'Kinh nghiệm',
                'children' => [
                    'Kinh nghiệm mua xe',
                    'Kinh nghiệm lái xe',
                ],
            ],
            [
                'name' => 'Hướng dẫn',
                'children' => [
                    'Bảo dưỡng xe',
                    'Thủ tục mua bán',
                ],
            ],
        ];

        foreach ($parents as $parentIndex => $parentData) {
            // ===== Category cha =====
            $parent = CategoryPost::create([
                'name' => $parentData['name'],
                'slug' => Str::slug($parentData['name']),
                'parent_id' => null,
                'description' => 'Danh mục ' . $parentData['name'],
                'meta_title' => $parentData['name'],
                'meta_description' => 'Các bài viết thuộc ' . $parentData['name'],
                'meta_keywords' => Str::slug($parentData['name'], ', '),
            ]);

            // ===== Category con =====
            foreach ($parentData['children'] as $index => $childName) {
                CategoryPost::create([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'parent_id' => $parent->id,
                    'description' => 'Danh mục ' . $childName,
                    'meta_title' => $childName,
                    'meta_description' => 'Các bài viết về ' . $childName,
                    'meta_keywords' => Str::slug($childName, ', '),
                ]);
            }
        }
    }
}
