<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktifMusteriler extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unvan',
        'fiyat',
        'tel',
        'mail',
        'yetkili_bir',
        'yetkili_bir_tel',
        'yetkili_bir_mail',
        'yetkili_iki',
        'yetkili_iki_tel',
        'yetkili_iki_mail',
        'fatura_adresi',
        'semt',
        'kent',
        'posta_kodu',
        'vergi_dairesi',
        'vergi_numarasi'
    ];
}
