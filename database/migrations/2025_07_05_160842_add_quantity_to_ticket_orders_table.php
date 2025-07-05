<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('ticket_orders', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('ticket_id'); // tambahkan kolom quantity setelah ticket_id
        });
    }

    public function down(): void {
        Schema::table('ticket_orders', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
