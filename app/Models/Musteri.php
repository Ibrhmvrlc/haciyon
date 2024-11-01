<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Musteri extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unvani',
        'tel_ana',
        'mail_ana',
        'yetkili_bir',
        'yetkili_bir_tel',
        'yetkili_bir_email',
        'yetkili_iki',
        'yetkili_iki_tel',
        'yetkili_iki_email',
        'yetkili_uc',
        'yetkili_uc_tel',
        'yetkili_uc_email',
        'fatura_adresi',
        'semt',
        'kent',
        'posta_kodu',
        'vergi_dairesi',
        'vergi_numarasi',
        'aktif_musteri',
        'yetkili_uc_email',
    ];
}
