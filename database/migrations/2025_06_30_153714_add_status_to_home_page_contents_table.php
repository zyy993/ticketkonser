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
    Schema::table('home_page_contents', function (Blueprint $table) {
        $table->string('status')->default('aktif'); // Hapus after()
    });
}


public function down()
{
    Schema::table('home_page_contents', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
