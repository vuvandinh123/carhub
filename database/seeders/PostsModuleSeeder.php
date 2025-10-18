<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Seed Categories
        $categories = collect();
        foreach (range(1, 5) as $i) {
            $categories->push(CategoryPost::create([
                'name' => $faker->unique()->word(),
                'slug' => Str::slug($faker->unique()->words(2, true)),
                'description' => $faker->sentence(),
            ]));
        }

        // Seed Tags
        $tags = collect();
        foreach (range(1, 10) as $i) {
            $tags->push(Tag::create([
                'name' => $faker->unique()->word(),
                'slug' => Str::slug($faker->unique()->words(2, true)),
            ]));
        }

        // Seed Posts
        foreach (range(1, 20) as $i) {
            $post = Post::create([
                'category_id' => $categories->random()->id,
                'title' => $faker->sentence(6),
                'slug' => Str::slug($faker->unique()->sentence(6)),
                'content' => $faker->paragraph(6, true),
                // 'excerpt' => $faker->sentence(20),
                'thumbnail' => $faker->imageUrl(640, 480, 'business', true),
                'meta_title' => $faker->sentence(6),
                'meta_description' => $faker->sentence(20),
                'meta_keywords' => implode(',', $faker->words(5)),
                'is_featured' => $faker->boolean(30),
                'user_id' => 1, // Assuming user with ID 1 exists
                'is_published' => $faker->boolean(70),
                'published_at' => $faker->dateTimeThisYear(),
            ]);

            // Attach random tags (1–4 tags per post)
            $post->tags()->attach(
                $tags->random(rand(1, 4))->pluck('id')->toArray()
            );
        }

    }
}
