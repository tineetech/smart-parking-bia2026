<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanan')->cascadeOnDelete();
            $table->decimal('jumlah', 10, 2);
            $table->enum('metode', ['transfer', 'qris', 'e-wallet']);
            $table->enum('status', ['menunggu', 'sukses', 'gagal'])->default('menunggu'); 
            $table->string('referensi_pembayaran', 100)->nullable()->unique();
            $table->timestamp('dibayar_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
