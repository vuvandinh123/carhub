<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Danh mục gốc
        $categories = [
            [
                'name' => 'SUV',
                'slug' => 'suv',
                'description' => 'Dòng xe gầm cao, phù hợp cho gia đình và địa hình phức tạp.',
                'content' => 'Chi tiết về các dòng xe SUV hiện có trên thị trường.',
                'thumbnail' => 'categories/thumbnails/suv.jpg',
                'parent_id' => null,
                'is_active' => true,
                'sort_order' => 1,
                'meta_title' => 'SUV - Danh mục xe',
                'meta_description' => 'Danh mục các loại xe SUV',
                'meta_keywords' => 'SUV, xe gầm cao, xe gia đình',
            ],
            [
                'name' => 'Sedan',
                'slug' => 'sedan',
                'description' => 'Dòng xe 4 chỗ phổ biến, nhỏ gọn và tiết kiệm nhiên liệu.',
                'content' => 'Chi tiết về các dòng xe Sedan.',
                'thumbnail' => 'categories/thumbnails/sedan.jpg',
                'parent_id' => null,
                'is_active' => true,
                'sort_order' => 2,
                'meta_title' => 'Sedan - Danh mục xe',
                'meta_description' => 'Danh mục các loại xe Sedan',
                'meta_keywords' => 'Sedan, xe 4 chỗ, xe gia đình',
            ],
            [
                'name' => 'Xe tải',
                'slug' => 'xe-tai',
                'description' => 'Xe tải phục vụ nhu cầu vận chuyển hàng hóa.',
                'content' => 'Danh mục xe tải các loại tải trọng.',
                'thumbnail' => 'categories/thumbnails/truck.jpg',
                'parent_id' => null,
                'is_active' => true,
                'sort_order' => 3,
                'meta_title' => 'Xe tải - Danh mục xe',
                'meta_description' => 'Danh mục các loại xe tải',
                'meta_keywords' => 'xe tải, truck, vận chuyển',
            ],
            [
                'name' => 'Xe điện',
                'slug' => 'xe-dien',
                'description' => 'Các mẫu xe điện hiện đại, thân thiện với môi trường.',
                'content' => 'Danh mục xe điện.',
                'thumbnail' => 'categories/thumbnails/electric.jpg',
                'parent_id' => null,
                'is_active' => true,
                'sort_order' => 4,
                'meta_title' => 'Xe điện - Danh mục xe',
                'meta_description' => 'Danh mục các loại xe điện',
                'meta_keywords' => 'xe điện, electric car, EV',
            ],
        ];

        foreach ($categories as $categoryData) {
            $parent = Category::create($categoryData);

            // Tạo thêm danh mục con cho mỗi danh mục gốc
            Category::create([
                'name' => $categoryData['name'] . ' cao cấp',
                'slug' => Str::slug($categoryData['slug'] . '-cao-cap'),
                'description' => 'Phiên bản cao cấp của ' . $categoryData['name'],
                'content' => 'Chi tiết về dòng xe cao cấp thuộc ' . $categoryData['name'],
                'thumbnail' => 'categories/thumbnails/' . $categoryData['slug'] . '-premium.jpg',
                'parent_id' => $parent->id,
                'is_active' => true,
                'sort_order' => 0,
                'meta_title' => $categoryData['name'] . ' cao cấp',
                'meta_description' => 'Danh mục xe ' . $categoryData['name'] . ' cao cấp',
                'meta_keywords' => $categoryData['slug'] . ', premium',
            ]);
        }
    }
}
