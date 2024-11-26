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
        Schema::create('detail_barangmasuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_masuk_id');
            $table->foreignId('product_id');
            $table->integer('jumlah_sarang');
            $table->integer('berat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
