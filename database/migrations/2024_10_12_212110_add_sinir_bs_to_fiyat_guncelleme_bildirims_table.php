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
            $table->unsignedBigInteger('sinir_bs')->after('tur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiyat_guncelleme_bildirims', function (Blueprint $table) {
            $table->dropColumn('sinir_bs');
        });
    }
};
