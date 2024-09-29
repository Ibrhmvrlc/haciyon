<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktifMusteriler extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aktif_musterilers';

    protected $fillable = [
        'unvan',
        'tel',
        'mail',
        'fatura_adresi',
        'semt',
        'kent',
        'posta_kodu',
        'vergi_dairesi',
        'vergi_numarasi'
    ];

    public function santiyeler()
    {
        return $this->hasMany(AktifMusteriSantiye::class, 'aktif_musteri_id');
    }

    public function fiyatlar()
    {
        return $this->hasMany(AktifSantiyeFiyat::class, 'aktif_musteri_id');
    }

    public function turs()
    {
        return $this->belongsToMany(Tur::class);
    }

    public function bildirimler()
    {
        return $this->hasMany(FiyatGuncellemeBildirim::class, 'musteri_id');
    }
}
