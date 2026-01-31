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
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->comment('ID danh mục');
            $table->string('name')->comment('Tên danh mục, ví dụ: SUV, Sedan');
            $table->string('slug')->unique()->comment('Slug dùng cho URL, ví dụ: suv, sedan');
            $table->text('description')->nullable()->comment('Mô tả ngắn gọn về danh mục');
            $table->text('content')->nullable()->comment('Nội dung chi tiết (giới thiệu danh mục)');
            $table->string('type')->nullable()->comment('Loại');
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện cho danh mục');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnDelete()
                ->comment('ID danh mục cha, hỗ trợ phân cấp');

            // Thêm các trường mới
            $table->boolean('is_active')->default(true)->comment('Trạng thái hiển thị: 1 = hoạt động, 0 = ẩn');
            $table->integer('sort_order')->default(0)->comment('Thứ tự hiển thị khi list danh mục');
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
        Schema::dropIfExists('categories');
    }
};
