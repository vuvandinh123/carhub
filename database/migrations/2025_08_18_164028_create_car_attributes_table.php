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
        Schema::create('car_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('type');   // fuel, body, transmission, color, origin
            $table->string('name');   // "Xăng", "SUV", "Số tự động"
            $table->string('slug')->unique();
            $table->json('extra')->nullable(); // thêm metadata, ví dụ hex_code màu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_attributes');
    }
};
