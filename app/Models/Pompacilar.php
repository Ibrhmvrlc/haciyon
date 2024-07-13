<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pompacilar extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_soyad',
        'gorevi',
        'zimmetli_arac_turu',
        'zimmetli_arac_plakasi',
        'yas',
    ];

    protected $dates = ['ise_giris', 'isten_cikis'];
}
