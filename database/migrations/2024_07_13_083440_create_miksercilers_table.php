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
        Schema::create('miksercilers', function (Blueprint $table) {
            $table->id();
            $table->string('ad_soyad');
            $table->string('gorevi');
            $table->string('zimmetli_arac_turu');
            $table->string('zimmetli_arac_plakasi')->nullable();
            $table->unsignedInteger('yas');
            $table->dateTime('ise_giris');
            $table->dateTime('isten_cikis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miksercilers');
    }
};
