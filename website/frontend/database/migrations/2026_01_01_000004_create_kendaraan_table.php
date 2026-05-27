<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('plat_nomor', 20)->unique();
            $table->string('merek', 50)->nullable();
            $table->string('model', 50)->nullable();
            $table->string('warna', 30)->nullable();
            $table->string('jenis', 15)->default('mobil'); // mobil | motor | truk
            $table->boolean('utama')->default(false);
            $table->timestamps();


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
