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
        Schema::create('fiyat_guncelleme_bildirims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musteri_id');
            $table->string('musteri_unvani');
            $table->string('tur');
            $table->string('tel')->nullable();
            $table->string('eposta')->nullable();
            $table->string('bildirim_sekli')->nullable();
            $table->boolean('bildirim_olacak_mi')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiyat_guncelleme_bildirims');
    }
};
