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
        Schema::create('aktif_santiye_metrajs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('aktif_santiye_id');
            $table->unsignedInteger('santiye_bir_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_iki_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_uc_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_dort_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_bes_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_alti_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_yedi_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_sekiz_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_dokuz_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_on_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_onbir_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_oniki_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_onuc_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_ondort_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_onbes_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_onalti_metraj')->nullable()->default(0);
            $table->unsignedInteger('santiye_onyedi_metraj')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktif_santiye_metrajs');
    }
};
