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
        Schema::create('aktif_santiye_fiyats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('aktif_santiye_id');
            $table->unsignedInteger('santiye_bir_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_iki_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_uc_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_dort_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_bes_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_alti_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_yedi_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_sekiz_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_dokuz_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_on_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_onbir_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_oniki_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_onuc_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_ondort_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_onbes_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_onalti_fiyat')->nullable()->default(0);
            $table->unsignedInteger('santiye_onyedi_fiyat')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktif_santiye_fiyats');
    }
};
