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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pompaci_id')->nullable();
            $table->datetime('baslangic_saati');
            $table->datetime('bitis_saati');
            $table->string('musteri_adi');
            $table->string('beton_cinsi');
            $table->string('dokum_sekli');
            $table->string('santiye');
            $table->double('metraj')->default(0);
            $table->string('yapi_elemani')->nullable();
            $table->string('odeme_bilgisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
