<?php

namespace App\Http\Controllers;

use App\Models\Musteri;
use Illuminate\Http\Request;

class MusteriController extends Controller
{
    public function index() {
       $title = 'Tüm Müşteriler';
       $musteriler = Musteri::all();
        
        return view('musteri.tum_musteriler', compact('title', 'musteriler'));
    }

    public function profile($id) {
        $musteri = Musteri::findOrFail($id);
        $title = 'Müşteri - ' . $musteri->unvani;

        $musteriler = Musteri::all();
         
         return view('musteri.musteri_profil', compact('title', 'musteri'));
     }
}
