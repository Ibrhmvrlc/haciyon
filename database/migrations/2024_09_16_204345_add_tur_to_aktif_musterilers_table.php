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
        Schema::table('aktif_musterilers', function (Blueprint $table) {
            $table->enum('turs', ['PARÇA BETON', 'PİYASA', 'TERSANELER', 'OSB', 'ÖZEL DÖKÜMLER', 'DİĞER','BOŞ'])->default('bos')->after('vergi_numarasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktif_musterilers', function (Blueprint $table) {
            $table->dropColumn('turs');
        });
    }
};
