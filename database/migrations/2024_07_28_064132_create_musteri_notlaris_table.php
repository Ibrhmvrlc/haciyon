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
        Schema::create('musteri_notlaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('musteri_id');
            $table->string('baslik');
            $table->text('not');
            $table->dateTime('hatirlatici')->nullable();
            $table->boolean('tamamlandi')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musteri_notlaris');
    }
};
