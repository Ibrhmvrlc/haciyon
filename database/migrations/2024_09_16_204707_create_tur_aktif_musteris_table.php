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
        Schema::create('tur_aktif_musteri', function (Blueprint $table) {
            $table->foreignId('aktif_musteri_id')->constrained('aktif_musterilers')->onDelete('cascade');
            $table->foreignId('tur_id')->constrained('turs')->onDelete('cascade');
            $table->primary(['aktif_musteri_id', 'tur_id']);
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tur_aktif_musteri');
    }
};
