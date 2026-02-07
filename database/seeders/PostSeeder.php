<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $posts = [
            [
                'title' => 'Kinh nghiệm mua xe ô tô lần đầu',
                'slug' => Str::slug('Kinh nghiệm mua xe ô tô lần đầu'),
                'content' => '<p>Nội dung chia sẻ kinh nghiệm mua xe ô tô lần đầu...</p>',
                'thumbnail' => 'posts/experience-buy-car.jpg',
                'user_id' => 1,
                'category_id' => 1,
                'is_published' => 1,
                'is_featured' => 1,
                'published_at' => $now,
                'meta_title' => 'Kinh nghiệm mua xe ô tô',
                'meta_description' => 'Những lưu ý quan trọng khi mua xe ô tô lần đầu',
                'meta_keywords' => 'mua xe ô tô, kinh nghiệm mua xe',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'So sánh Toyota và Honda',
                'slug' => Str::slug('So sánh Toyota và Honda'),
                'content' => '<p>So sánh chi tiết Toyota và Honda về giá, độ bền...</p>',
                'thumbnail' => 'posts/toyota-vs-honda.jpg',
                'user_id' => 1,
                'category_id' => 1,
                'is_published' => 1,
                'is_featured' => 0,
                'published_at' => $now,
                'meta_title' => 'So sánh Toyota và Honda',
                'meta_description' => 'Đánh giá Toyota và Honda nên mua hãng nào',
                'meta_keywords' => 'toyota, honda, so sánh xe',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Có nên mua xe cũ không?',
                'slug' => Str::slug('Có nên mua xe cũ không'),
                'content' => '<p>Phân tích ưu nhược điểm khi mua xe ô tô cũ...</p>',
                'thumbnail' => 'posts/buy-used-car.jpg',
                'user_id' => 1,
                'category_id' => 2,
                'is_published' => 0,
                'is_featured' => 0,
                'published_at' => null,
                'meta_title' => 'Có nên mua xe cũ',
                'meta_description' => 'Ưu nhược điểm của việc mua xe ô tô cũ',
                'meta_keywords' => 'xe cũ, mua xe cũ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('posts')->insert($posts);
    }
}
