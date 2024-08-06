<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifSantiyeFiyat extends Model
{
    use HasFactory;

    protected $fillable = [
        'aktif_santiye_id',
        'santiye_bir_fiyat',
        'santiye_iki_fiyat',
        'santiye_uc_fiyat',
        'santiye_dort_fiyat',
        'santiye_bes_fiyat',
        'santiye_alti_fiyat',
        'santiye_yedi_fiyat',
        'santiye_sekiz_fiyat',
        'santiye_dokuz_fiyat',
        'santiye_on_fiyat',
        'santiye_onbir_fiyat',
        'santiye_oniki_fiyat',
        'santiye_onuc_fiyat',
        'santiye_ondort_fiyat',
        'santiye_onbes_fiyat',
        'santiye_onalti_fiyat',
        'santiye_onyedi_fiyat',
    ];
}
