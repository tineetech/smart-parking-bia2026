<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slot_parkir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_parkir_id')->constrained('lokasi_parkir')->cascadeOnDelete();
            $table->string('kode_slot', 10);
            $table->string('lantai', 10)->nullable();
            $table->string('zona', 10)->nullable();
            $table->string('jenis_slot', 15)->default('reguler'); // reguler | disabilitas | vip
            $table->string('status', 15)->default('tersedia');   // tersedia | terisi | dipesan | nonaktif
            $table->foreignId('id_sensor')->nullable()->constrained('sensor')->cascadeOnDelete();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slot_parkir');
    }
};
