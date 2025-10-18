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
        Schema::create('category_posts', function (Blueprint $table) {
            $table->id()->comment('ID danh mục');
            $table->string('name')->comment('Tên danh mục');
            $table->string('slug')->unique()->comment('Đường dẫn tĩnh');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade')->comment('Danh mục cha');
            $table->text('description')->nullable()->comment('Mô tả ngắn');

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
        Schema::dropIfExists('categories_post');
    }
};
