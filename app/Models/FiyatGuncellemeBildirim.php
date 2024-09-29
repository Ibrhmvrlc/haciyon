<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiyatGuncellemeBildirim extends Model
{
    use HasFactory;

    protected $table = 'fiyat_guncelleme_bildirims'; // Veritabanı tablonuzun adı
    protected $fillable = ['musteri_id', 'tur', 'musteri_unvani', 'tel', 'eposta', 'bildirim_sekli', 'bildirim_olacak_mi']; // Doldurulabilir alanlar
    
    public function musteri()
    {
        return $this->belongsTo(AktifMusteriler::class, 'musteri_id');
    }
}
