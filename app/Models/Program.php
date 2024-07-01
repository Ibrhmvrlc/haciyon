<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'pompaci',
        'baslangic_saati',
        'bitis_saati',
        'musteri_adi',
        'dokum_sekli',
        'santiye',
        'metraj',
        'yapi_elemani',
        'odeme_bilgisi'
    ];

    protected $dates = ['baslangic_saati', 'bitis_saati'];

}
