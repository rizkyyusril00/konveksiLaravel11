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
            $table->unsignedBigInteger('customer_id');
            $table->string('admin');
            $table->date('tanggal_order');
            $table->date('tanggal_selesai');
            $table->string('jenis_pakaian');
            $table->string('bahan_utama');
            $table->string('bahan_tambahan')->nullable();
            $table->string('jenis_kancing')->nullable();
            $table->unsignedBigInteger('penjahit_id'); // Foreign key ke tabel karyawans
            $table->unsignedBigInteger('pemotong_id'); // Foreign key ke tabel karyawans
            $table->json('items')->nullable();
            $table->string('status');
            $table->string('diskon')->nullable();
            $table->string('pajak')->nullable();
            $table->string('note')->nullable();
            $table->string('image_order')->nullable();
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
