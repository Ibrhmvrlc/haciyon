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
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('Pompaci')->nullable();
            $table->string('Musteri_Adi');
            $table->string('Dokum_Sekli');
            $table->string('Santiye');
            $table->double('Metraj')->default(0);
            $table->string('Yapi_Elemani')->nullable();
            $table->string('Odeme_Bilgisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
