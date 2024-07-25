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
        Schema::create('musteris', function (Blueprint $table) {
            $table->id();
            $table->string('unvani');
            $table->unsignedInteger('tel_ana');
            $table->string('mail_ana');
            $table->string('yetkili_bir');
            $table->unsignedInteger('yetkili_bir_tel');
            $table->string('yetkili_bir_email');
            $table->string('yetkili_iki')->nullable();
            $table->unsignedInteger('yetkili_iki_tel')->nullable();
            $table->string('yetkili_iki_email')->nullable();
            $table->string('yetkili_uc')->nullable();
            $table->unsignedInteger('yetkili_uc_tel')->nullable();
            $table->string('yetkili_uc_email')->nullable();
            $table->text('fatura_adresi');
            $table->string('sokak')->nullable();
            $table->string('semt');
            $table->string('kent');
            $table->unsignedInteger('posta_kodu');
            $table->string('vergi_dairesi');
            $table->unsignedInteger('vergi_numarasi');
            $table->boolean('aktif_musteri')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musteris');
    }
};
