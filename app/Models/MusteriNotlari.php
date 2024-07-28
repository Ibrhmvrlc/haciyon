<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MusteriNotlari extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'musteri_id',
        'baslik',
        'not',
        'tamamlandi',
    ];

    protected $dates = ['hatirlatici'];
}
