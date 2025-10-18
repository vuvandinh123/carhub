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
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id()->comment('ID liên kết bài viết - tag');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade')->comment('Bài viết');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade')->comment('Tag');
            $table->timestamps();

            $table->unique(['post_id', 'tag_id'], 'post_tag_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
