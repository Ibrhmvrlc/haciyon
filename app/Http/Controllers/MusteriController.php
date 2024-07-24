<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusteriController extends Controller
{
    public function index() {
       $title = 'Tüm Müşteriler';
        
        return view('musteri.tum_musteriler', compact('title'));
    }
}
