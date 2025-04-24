<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     * Menambahkan kolom 'role' ke tabel 'users' dengan nilai default 'user'.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // tambahkan kolom role (string) dengan default 'user'
            $table->string('role')->default('user');
        });
    }

    /**
     * Mengembalikan perubahan (rollback).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // di sini bisa ditambahkan logika untuk menghapus kolom 'role' saat rollback
            // misalnya: $table->dropColumn('role');
        });
    }
};
