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
        Schema::table('admins', function (Blueprint $table) {
            // HANYA TAMBAHKAN KOLOM is_superadmin
            // Kolom is_active sudah ada dari migrasi lain.
            $table->boolean('is_superadmin')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            // Perintah untuk membatalkan migrasi
            $table->dropColumn('is_superadmin');
        });
    }
};
