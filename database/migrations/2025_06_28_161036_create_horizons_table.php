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
    Schema::create('horizons', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('penyanyi');
        $table->date('date');
        $table->dateTime('gates_open')->nullable();
        $table->dateTime('show_starts')->nullable();
        $table->dateTime('expired_at')->nullable();
        $table->text('deskripsi')->nullable();
        $table->string('location');
        $table->integer('price');
        $table->string('image_path')->nullable();
        $table->timestamps();
    });
}

};
