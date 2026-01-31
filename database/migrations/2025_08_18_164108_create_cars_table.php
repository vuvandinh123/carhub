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
        Schema::create('cars', function (Blueprint $table) {
            $table->id()->comment('ID xe');
            $table->string('title')->comment('Tên xe, ví dụ: Toyota Vios 2024');
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện chính của xe');

            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnDelete()
                ->comment('Thương hiệu xe, FK -> brands');

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete()
                ->comment('Danh mục xe, FK -> categories');

            $table->decimal('price', 15, 2)->nullable()->comment('Giá bán (VND)');
            $table->integer('year')->nullable()->comment('Năm sản xuất');
            $table->integer('quantity')->default(1)->comment('Số lượng');
            $table->integer('mileage')->nullable()->comment('Số km đã đi (nếu xe cũ)');

            $table->string('engine')->nullable()->comment('Động cơ, ví dụ: 2.0L Turbo, 150kW');
            $table->integer('seats')->nullable()->comment('Số chỗ ngồi');

            $table->enum('status', ['available', 'sold', 'coming_soon'])
                ->default('available')
                ->comment('Trạng thái: available = còn bán, sold = đã bán, coming_soon = sắp ra mắt');
            $table->string('fuel')->nullable()->comment('Loại nhiên liệu, ví dụ: xăng, dầu, điện');
            
            $table->text('description')->nullable()->comment('Mô tả ngắn gọn về xe');
            $table->text('content')->nullable()->comment('Nội dung chi tiết (bài viết giới thiệu xe)');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete()
                ->comment('Người tạo (admin), FK -> users');
            $table->string('meta_title')->nullable()->comment('SEO: thẻ meta title');
            $table->string('meta_description')->nullable()->comment('SEO: thẻ meta description');
            $table->string('meta_keywords')->nullable()->comment('SEO: thẻ meta keywords');
            $table->timestamps();
            $table->softDeletes()->comment('Thời điểm xóa mềm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
