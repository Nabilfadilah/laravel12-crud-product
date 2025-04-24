<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     * Menambahkan kolom 'user_id' ke tabel 'products' jika belum ada.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // cek apakah kolom 'user_id' belum ada
            if (!Schema::hasColumn('products', 'user_id')) {
                // tambahkan foreign key 'user_id' yang terhubung ke tabel users
                // jika user dihapus, produk yang berkaitan juga ikut dihapus (cascade)
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Mengembalikan perubahan (rollback).
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // di sini bisa ditambahkan logika untuk menghapus kolom 'user_id' saat rollback
            // misalnya: $table->dropForeign(['user_id']); $table->dropColumn('user_id');
        });
    }
};
