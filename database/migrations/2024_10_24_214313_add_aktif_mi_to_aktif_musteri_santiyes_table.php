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
        Schema::table('aktif_musteri_santiyes', function (Blueprint $table) {
            $table->boolean('aktif_mi')->default(true)->after('santiye');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktif_musteri_santiyes', function (Blueprint $table) {
            $table->dropColumn('aktif_mi');
        });
    }
};
