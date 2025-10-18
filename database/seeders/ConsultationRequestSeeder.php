<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ConsultationRequestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        foreach (range(1, 20) as $index) {
            DB::table('consultation_requests')->insert([
                'user_id' => $faker->optional()->numberBetween(1, 1),
                'car_id' => $faker->optional()->numberBetween(1, 3),
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->optional()->safeEmail,
                'note' => $faker->optional()->sentence(8),
                'source' => $faker->randomElement(['website','facebook','zalo','offline','other']),
                'preferred_contact_time' => $faker->randomElement(['sáng', 'chiều', 'tối']),
                'status' => $faker->randomElement(['pending','contacted','in_progress','closed']),
                'assigned_to' => $faker->optional()->numberBetween(1, 1),
                'contacted_at' => $faker->optional()->dateTimeThisMonth(),
                'closed_at' => $faker->optional()->dateTimeThisMonth(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
