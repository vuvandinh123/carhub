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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ID người dùng');
            $table->string('name')->comment('Tên đầy đủ của người dùng');
            $table->string('username')->nullable()->unique()->comment('Tên đăng nhập');
            $table->string('email')->nullable()->unique()->comment('Email đăng nhập');
            $table->string('phone')->unique()->comment('Số điện thoại');
            $table->string('avatar')->nullable()->comment('Ảnh đại diện');

            $table->timestamp('email_verified_at')->nullable()->comment('Thời điểm xác thực email');
            $table->timestamp('phone_verified_at')->nullable()->comment('Thời điểm xác thực số điện thoại');

            $table->string('password')->comment('Mật khẩu đã hash');

            $table->enum('role', ['admin', 'consultant', 'customer'])
                ->default('customer')
                ->comment('Vai trò của người dùng');

            $table->boolean('is_active')->default(true)->comment('Trạng thái hoạt động: 1 = đang hoạt động, 0 = bị khóa');
            $table->timestamp('last_login_at')->nullable()->comment('Lần đăng nhập gần nhất');
            $table->string('last_login_ip')->nullable()->comment('Địa chỉ IP của lần đăng nhập gần nhất');

            $table->rememberToken()->comment('Token để ghi nhớ đăng nhập');
            $table->timestamps();
            $table->softDeletes()->comment('Xóa mềm');
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
