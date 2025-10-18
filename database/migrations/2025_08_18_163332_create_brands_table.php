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
        Schema::create('brands', function (Blueprint $table) {
            $table->id()->comment('ID thương hiệu');
            $table->string('name')->comment('Tên thương hiệu, ví dụ: Toyota, BMW');
            $table->string('slug')->unique()->comment('Slug cho URL: toyota, bmw');
            $table->string('logo')->nullable()->comment('Logo thương hiệu');
            $table->text('description')->nullable()->comment('Mô tả ngắn gọn về thương hiệu');
            $table->text('content')->nullable()->comment('Giới thiệu chi tiết về thương hiệu');
            $table->string('country')->nullable()->comment('Quốc gia của thương hiệu');

            // Bổ sung
            $table->string('website')->nullable()->comment('Website chính thức của thương hiệu');
            $table->string('founded_year')->nullable()->comment('Năm thành lập thương hiệu');

            $table->boolean('is_active')->default(true)->comment('Trạng thái hiển thị: 1 = hoạt động, 0 = ẩn');
            $table->integer('sort_order')->default(0)->comment('Thứ tự hiển thị khi list thương hiệu');
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
        Schema::dropIfExists('brands');
    }
};
