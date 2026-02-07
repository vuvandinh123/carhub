<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\ConsultationRequest;
use App\Models\User;
use App\Models\Car;

class ConsultationRequestSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $cars  = Car::pluck('id')->toArray();

        $requests = [
            [
                'name' => 'Nguyễn Văn A',
                'phone' => '0901234567',
                'email' => 'a.nguyen@gmail.com',
                'note' => 'Quan tâm xe SUV 7 chỗ, cần tư vấn giá.',
                'source' => 'website',
                'preferred_contact_time' => 'Sáng',
                'status' => 'pending',
            ],
            [
                'name' => 'Trần Thị B',
                'phone' => '0912345678',
                'email' => 'b.tran@gmail.com',
                'note' => 'Muốn so sánh sedan hạng C.',
                'source' => 'facebook',
                'preferred_contact_time' => 'Chiều',
                'status' => 'contacted',
                'contacted_at' => Carbon::now()->subDays(1),
            ],
            [
                'name' => 'Lê Văn C',
                'phone' => '0987654321',
                'email' => null,
                'note' => 'Hỏi về chương trình trả góp.',
                'source' => 'zalo',
                'preferred_contact_time' => 'Tối',
                'status' => 'in_progress',
                'contacted_at' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'Phạm Thị D',
                'phone' => '0978123456',
                'email' => 'd.pham@gmail.com',
                'note' => 'Đã chốt mua xe, cần hoàn tất hồ sơ.',
                'source' => 'offline',
                'preferred_contact_time' => 'Sáng',
                'status' => 'closed',
                'contacted_at' => Carbon::now()->subDays(3),
                'closed_at' => Carbon::now()->subDay(),
            ],
        ];

        foreach ($requests as $data) {
            ConsultationRequest::create([
                'user_id' => $users ? $users[array_rand($users)] : null,
                'car_id' => $cars ? $cars[array_rand($cars)] : null,
                'assigned_to' => $users ? $users[array_rand($users)] : null,

                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'note' => $data['note'],
                'source' => $data['source'],
                'preferred_contact_time' => $data['preferred_contact_time'],
                'status' => $data['status'],

                'contacted_at' => $data['contacted_at'] ?? null,
                'closed_at' => $data['closed_at'] ?? null,
            ]);
        }
    }
}
