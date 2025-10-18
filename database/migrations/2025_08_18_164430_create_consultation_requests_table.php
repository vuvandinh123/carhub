<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();

            // Liên kết với user và car
            $table->foreignId('user_id')->nullable()
                ->constrained()->nullOnDelete()
                ->comment('Người dùng (nếu đã đăng ký tài khoản)');
            $table->foreignId('car_id')->nullable()
                ->constrained()->nullOnDelete()
                ->comment('Xe mà khách hàng quan tâm');

            // Thông tin liên hệ
            $table->string('name')->comment('Tên khách hàng');
            $table->string('phone')->comment('Số điện thoại liên hệ');
            $table->string('email')->nullable()->comment('Email khách hàng');

            // Nội dung yêu cầu
            $table->text('note')->nullable()->comment('Ghi chú của khách hàng');
            $table->enum('source', ['website', 'facebook', 'zalo', 'offline', 'other'])
                ->default('website')
                ->comment('Nguồn khách hàng đến từ đâu');
            $table->string('preferred_contact_time')->nullable()
                ->comment('Thời gian khách hàng muốn được liên hệ (VD: sáng, chiều, tối)');

            // Quản lý yêu cầu
            $table->enum('status', ['pending', 'contacted', 'in_progress', 'closed'])
                ->default('pending')
                ->comment('Trạng thái xử lý yêu cầu');
            $table->foreignId('assigned_to')->nullable()
                ->constrained('users')->nullOnDelete()
                ->comment('Nhân viên tư vấn phụ trách yêu cầu này');

            $table->timestamp('contacted_at')->nullable()->comment('Thời điểm đã liên hệ khách hàng');
            $table->timestamp('closed_at')->nullable()->comment('Thời điểm đóng yêu cầu');

            // Audit
            $table->softDeletes()->comment('Xóa mềm');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
