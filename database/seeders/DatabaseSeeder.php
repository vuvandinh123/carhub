<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // CarSpecificationSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            CategoryPostSeeder::class,
            ConsultationRequestSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            CarSeeder::class,
            CarSpecificationSeeder::class,
        ]);
    }
}
