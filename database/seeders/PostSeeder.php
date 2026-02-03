<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Post;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'category_id' => 1, // Sửa lại cho phù hợp nếu có nhiều category
                'title' => 'Bài viết mẫu số ' . $i,
                'slug' => Str::slug('Bài viết mẫu số ' . $i . '-' . Str::random(5)),
                'content' => 'Nội dung chi tiết cho bài viết mẫu số ' . $i . '. Đây là nội dung mô tả chi tiết.',
                'excerpt' => 'Đây là đoạn trích ngắn cho bài viết mẫu số ' . $i . '.',
                'thumbnail' => "https://cdn.gianhangvn.com/image/honda-civic-of2gkgq.jpg",
                'meta_title' => 'SEO Title cho bài viết mẫu số ' . $i,
                'meta_description' => 'SEO Description cho bài viết mẫu số ' . $i,
                'meta_keywords' => 'car, blog, post, sample',
                'is_published' => true,
                'published_at' => $now->copy()->subDays($i),
                'user_id' => 1, // Giả sử user_id 1 là admin
            ]);
        }
    }
}
