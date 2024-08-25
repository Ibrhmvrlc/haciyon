<?php

namespace App\Http\Controllers;

use App\Models\AktifSantiyeFiyat;
use Illuminate\Http\Request;

class ZamAPIController extends Controller
{
    public function update(Request $request, $id)
    {
    // İlgili veriyi bul
    $veriler = AktifSantiyeFiyat::findOrFail($id);

    // Güncellenmesi gereken alanları teker teker güncelle
    $veriler->beton_sinifi = $request->input('Beton Sınıfı');
    $veriler->fiyat = $request->input('Fiyat');
    $veriler->katki_farki = $request->input('Katkı (+)');
    $veriler->artis = $request->input('Üst Sınıf (+)');
    $veriler->azalis = $request->input('Alt Sınıf (-)');
    $veriler->pb = $request->input('Pompa Fiyatı');

    // Veriyi kaydet
    $veriler->save();

    // Güncellenen veriyi yanıt olarak döndür
    return response()->json($veriler);
    }
}
