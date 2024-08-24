<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktifMusteriYetkililer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'aktif_musteri_id',
        'adi_soyadi',
        'tel',
        'mail'
    ];
}
