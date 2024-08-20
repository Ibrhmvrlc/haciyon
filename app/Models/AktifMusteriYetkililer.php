<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifMusteriYetkililer extends Model
{
    use HasFactory;

    protected $fillable = [
        'aktif_musteri_id',
        'adi_soyadi',
        'tel',
        'mail'
    ];
}
