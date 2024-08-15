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
        Schema::create('aktif_santiye_fiyat_sinifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('aktif_santiye_fiyat_id');
            $table->string('santiye_bir_fiyat_sinif')->nullable();
            $table->string('santiye_iki_fiyat_sinif')->nullable();
            $table->string('santiye_uc_fiyat_sinif')->nullable();
            $table->string('santiye_dort_fiyat_sinif')->nullable();
            $table->string('santiye_bes_fiyat_sinif')->nullable();
            $table->string('santiye_alti_fiyat_sinif')->nullable();
            $table->string('santiye_yedi_fiyat_sinif')->nullable();
            $table->string('santiye_sekiz_fiyat_sinif')->nullable();
            $table->string('santiye_dokuz_fiyat_sinif')->nullable();
            $table->string('santiye_on_fiyat_sinif')->nullable();
            $table->string('santiye_onbir_fiyat_sinif')->nullable();
            $table->string('santiye_oniki_fiyat_sinif')->nullable();
            $table->string('santiye_onuc_fiyat_sinif')->nullable();
            $table->string('santiye_ondort_fiyat_sinif')->nullable();
            $table->string('santiye_onbes_fiyat_sinif')->nullable();
            $table->string('santiye_onalti_fiyat_sinif')->nullable();
            $table->string('santiye_onyedi_fiyat_sinif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktif_santiye_fiyat_sinifs');
    }
};
