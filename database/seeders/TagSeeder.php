<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Xe SUV',
            'Xe Sedan',
            'Xe Hatchback',
            'Xe MPV',
            'Xe Bán Tải',
            'Xe Điện',
            'Xe Hybrid',
            'So Sánh Xe',
            'Đánh Giá Xe',
            'Kinh Nghiệm Mua Xe',
            'Bảo Dưỡng Xe',
            'Tin Tức Ô Tô',
        ];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'meta_title' => $name,
                'meta_description' => 'Bài viết liên quan đến ' . mb_strtolower($name),
                'meta_keywords' => Str::slug($name, ', '),
            ]);
        }
    }
}
