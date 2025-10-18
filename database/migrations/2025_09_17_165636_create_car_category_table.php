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
        Schema::create('car_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->comment('ID xe');
            $table->unsignedBigInteger('category_id')->comment('ID danh mục');
            $table->timestamps();

            // unique để tránh trùng lặp xe - danh mục
            $table->unique(['car_id', 'category_id']);

            // Khóa ngoại
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_category');
    }
};
