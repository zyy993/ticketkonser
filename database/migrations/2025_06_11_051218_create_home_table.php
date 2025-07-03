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
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->string('name');
            $table->string('penyanyi');
            $table->dateTime('date');
            $table->dateTime('gates_open')->nullable();   // Tambahan
            $table->dateTime('show_starts')->nullable();  // Tambahan
            $table->text('deskripsi')->nullable();        // Tambahan
            $table->dateTime('expired_at')->nullable();   // Tambahan
            $table->decimal('price', 10, 2); // 10 total digit, 2 digit desimal

            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_contents');
    }
};
