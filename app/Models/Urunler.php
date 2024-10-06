<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urunler extends Model
{
    use HasFactory;

    protected $fillable = [
        'adi',
        'aciklama'
    ];

    public function fiyat() {
        return $this->hasMany(AktifSantiyeFiyat::class, 'beton_sinifi');
    }
}
