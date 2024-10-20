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
            $table->string('tel_iki')->nullable()->after('tel_bir');
            $table->string('tel_uc')->nullable()->after('tel_iki');
            $table->string('tel_dort')->nullable()->after('tel_uc');
            $table->string('tel_bes')->nullable()->after('tel_dort');
            $table->string('eposta_iki')->nullable()->after('eposta_bir');
            $table->string('eposta_uc')->nullable()->after('eposta_iki');
            $table->string('eposta_dort')->nullable()->after('eposta_uc');
            $table->string('eposta_bes')->nullable()->after('eposta_dort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiyat_guncelleme_bildirims', function (Blueprint $table) {
            $table->dropColumn(['tel_iki', 'tel_uc', 'tel_dort', 'tel_bes',
             'eposta_iki', 'eposta_uc', 'eposta_dort', 'eposta_bes']);
        });
    }
};
