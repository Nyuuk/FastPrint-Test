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
        Schema::create('produks', function (Blueprint $table) {
            // make a table which has id_produk, nama_produk, harga, kategori_id, status_id
            $table->id("id_produk");
            $table->string('nama');
            $table->integer('harga');
            $table->foreignId('kategori_id')->nullable(true);
            $table->foreignId('status_id')->nullable(true);
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris');
            $table->foreign('status_id')->references('id_status')->on('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
