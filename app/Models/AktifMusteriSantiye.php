<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifMusteriSantiye extends Model
{
    use HasFactory;

    protected $table = 'aktif_musteri_santiyes';

    protected $fillable = [
        'aktif_musteri_id',
        'santiye'
    ];

    public function musteriler()
    {
        return $this->hasOne(AktifMusteriler::class, 'id');
    }

    public function fiyatlar()
    {
        return $this->hasOne(AktifSantiyeFiyat::class, 'id');
    }
}
