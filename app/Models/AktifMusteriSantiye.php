<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifMusteriSantiye extends Model
{
    use HasFactory;

    protected $fillable = [
        'aktif_musteri_id',
        'santiye_bir',
        'santiye_iki',
        'santiye_uc',
        'santiye_dort',
        'santiye_bes',
        'santiye_alti',
        'santiye_yedi',
        'santiye_sekiz',
        'santiye_dokuz',
        'santiye_on',
        'santiye_onbir',
        'santiye_oniki',
        'satiye_onuc',
        'santiye_ondort',
        'santiye_onbes',
        'santiye_onalti',
        'santiye_onyedi',
    ];
}
