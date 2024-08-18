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
        Schema::table('aktif_santiye_fiyats', function (Blueprint $table) {
            $table->integer('pb_siniri')->after('pb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktif_santiye_fiyats', function (Blueprint $table) {
            $table->dropColumn('pb_siniri');
        });
    }
};
