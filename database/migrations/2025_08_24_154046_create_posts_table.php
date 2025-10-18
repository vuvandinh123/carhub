<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->comment('ID bài viết');
            $table->string('title')->comment('Tiêu đề bài viết');
            $table->string('slug')->unique()->comment('Đường dẫn tĩnh');
            $table->longText('content')->nullable()->comment('Nội dung chi tiết');
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện');

            $table->foreignId('user_id')->constrained()->comment('Người tạo bài viết');
            $table->foreignId('category_id')->constrained('categories')->comment('Danh mục');

            $table->boolean('is_published')->default(false)->comment('Trạng thái xuất bản');
            $table->boolean('is_featured')->default(false)->comment('Trạng thái nổi bật');
            $table->timestamp('published_at')->nullable()->comment('Thời gian xuất bản');

            // SEO meta
            $table->string('meta_title')->nullable()->comment('SEO Meta Title');
            $table->string('meta_description')->nullable()->comment('SEO Meta Description');
            $table->string('meta_keywords')->nullable()->comment('SEO Meta Keywords');

            $table->timestamps();
            $table->softDeletes()->comment('Xóa mềm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
