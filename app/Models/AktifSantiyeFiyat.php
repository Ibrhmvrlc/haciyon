<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifSantiyeFiyat extends Model
{
    use HasFactory;

    protected $fillable = [
        'aktif_musteri_id',
        'santiye_id',
        'beton_sinifi',
        'fiyat',
        'katki_farki',
        'ozel_farki',
        'artis',
        'azalis'
    ];

    public function musteri()
    {
        return $this->hasOne(AktifMusteriler::class, 'id');
    }

    public function santiye()
    {
        return $this->hasOne(AktifMusteriSantiye::class, 'id');
    }

    public function betonSinifi()
    {
        return $this->belongsTo(Urunler::class, 'beton_sinifi', 'id');
    }
}
