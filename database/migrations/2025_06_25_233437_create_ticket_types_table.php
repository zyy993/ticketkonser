<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ticket_types', function (Blueprint $table) {
        $table->id();
        $table->foreignId('home_id')->constrained('home_page_contents')->onDelete('cascade');
        $table->string('jenis_tiket'); // VVIP, VIP, Reguler, dll
        $table->decimal('harga', 10, 2);
        $table->string('seat_number')->nullable(); // Jika sistemnya seat-based
        $table->enum('status', ['available', 'booked'])->default('available');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
