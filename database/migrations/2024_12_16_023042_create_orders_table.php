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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('admin');
            $table->date('tanggal_order');
            $table->date('tanggal_selesai');
            $table->string('jenis_pakaian');
            $table->string('bahan_utama');
            $table->string('bahan_tambahan')->nullable();
            $table->string('jenis_kancing');
            $table->unsignedBigInteger('penjahit_id'); // Foreign key ke tabel karyawans
            $table->unsignedBigInteger('pemotong_id'); // Foreign key ke tabel karyawans
            $table->string('quantity'); // Gabungan size dan jumlah potong
            $table->string('quantity_2')->nullable();
            $table->string('harga_satuan');
            $table->string('harga_satuan_2')->nullable();
            $table->integer('total_harga');
            $table->integer('total_harga_2')->nullable();
            $table->string('status');
            $table->string('image_order')->nullable();
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('penjahit_id')->references('id')->on('karyawans')->onDelete('cascade');
            $table->foreign('pemotong_id')->references('id')->on('karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
