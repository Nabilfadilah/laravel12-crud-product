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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // primary
            $table->string('name'); // nama product
            $table->text('description')->nullable(); // deskripsi product
            $table->decimal('price', 10, 2); // harga produk
            $table->string('image')->nullable(); // lokasi gambar product
            $table->timestamps(); // create_at & update_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
