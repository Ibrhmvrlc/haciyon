<?php

namespace App\Http\Controllers;

use App\Models\AktifMusteriler;
use App\Models\AktifSantiyeFiyat;
use Illuminate\Http\Request;

class ZamAPIController extends Controller
{
    public function update(Request $request, $id)
    {
    // İlgili veriyi bul
    $dbsave = AktifSantiyeFiyat::findOrFail($id);

    if($dbsave->beton_sinifi != $request->input('beton_sinifi')) {
        $dbsave->beton_sinifi = $request->input('beton_sinifi');
    }

    if($dbsave->fiyat != $request->input('fiyat')) {
        $dbsave->fiyat = $request->input('fiyat');
    }

    if($dbsave->katki_farki != $request->input('katki_farki')) {
        $dbsave->katki_farki = $request->input('katki_farki');
    }

    if($dbsave->artis != $request->input('artis')) {
        $dbsave->artis = $request->input('artis');
    }

    if($dbsave->azalis != $request->input('azalis')) {
        $dbsave->azalis = $request->input('azalis');
    }

    if($dbsave->pb != $request->input('pb')) {
        $dbsave->pb = $request->input('pb');
    }

    // Veriyi kaydet
    $dbsave->save();

     // Müşteri, şantiye ve fiyat ilişkilerini çekiyoruz
     $musteriler = AktifMusteriler::with(['santiyeler.fiyatlar'])->get();

     $veriler = [];

     foreach ($musteriler as $musteri) {
         foreach ($musteri->santiyeler as $santiye) {
             $fiyatlar = [];
             foreach ($musteri->fiyatlar as $fiyat) {
                 $fiyatlar[] = [
                     'beton_sinifi' => $fiyat->beton_sinifi ?? 0,
                     'fiyat' => $fiyat->fiyat ?? 0,
                     'katki_farki' => $fiyat->katki_farki ?? 0,
                     'artis' => $fiyat->artis ?? 0,
                     'azalis' => $fiyat->azalis ?? 0,
                     'pb' => $fiyat->pb ?? 0,
                 ];
             }
             $veriler[] = [
                 'id' => $santiye->id ?? '',
                 'musteri' => $musteri->unvan,
                 'santiye' => $santiye->santiye,
                 'beton_sinifi' => $fiyat->beton_sinifi,
                 'fiyat' => $fiyat->fiyat,
                 'katki_farki' => $fiyat->katki_farki,
                 'artis' => $fiyat->artis,
                 'azalis' => $fiyat->azalis,
                 'pb' => $fiyat->pb,
             ];
         }
     }

    // Güncellenen veriyi yanıt olarak döndür
    return response()->json($veriler);
    }
}
