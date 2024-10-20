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
        Schema::table('fiyat_guncelleme_bildirims', function (Blueprint $table) {
            $table->renameColumn('tel', 'tel_bir');
            $table->renameColumn('eposta', 'eposta_bir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiyat_guncelleme_bildirims', function (Blueprint $table) {
            $table->renameColumn('tel_bir', 'tel');
            $table->renameColumn('eposta_bir', 'eposta');
        });
    }
};
