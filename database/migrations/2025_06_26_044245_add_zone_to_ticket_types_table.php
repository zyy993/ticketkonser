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
    Schema::table('ticket_types', function (Blueprint $table) {
        $table->string('zone')->nullable()->after('jenis_tiket');
    });
}

public function down()
{
    Schema::table('ticket_types', function (Blueprint $table) {
        $table->dropColumn('zone');
    });
}

};
