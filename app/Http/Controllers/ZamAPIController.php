<?php

namespace App\Http\Controllers;

use App\Models\AktifMusteriler;
use App\Models\AktifSantiyeFiyat;
use Illuminate\Http\Request;

class ZamAPIController extends Controller
{
    public function update(Request $request, $id) {
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

        if ($dbsave) {
            $dbsave->update($request->all()); // Tüm gelen verileri güncelle
            return response()->json(['success' => true, 'message' => 'Data updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Data not found!'], 404);

    }

    // Veriyi çek
    public function getData()
    {
        // Müşteri, şantiye ve fiyat ilişkilerini çekiyoruz
        $musteriler = AktifMusteriler::with(['santiyeler.fiyatlar'])->get();

        $veriler = []; // Verileri dışarıda başlat 

        foreach ($musteriler as $musteri) {
            foreach ($musteri->santiyeler as $santiye) {
            $fiyat = AktifSantiyeFiyat::where('id', $santiye->id)->get();     
                    $veriler[] = [
                        'id' => $santiye->id,
                        'musteri' => $musteri->unvan,
                        'santiye' => $santiye->santiye,
                        'beton_sinifi' => $fiyat->first()->beton_sinifi ?? 0,
                        'fiyat' => $fiyat->first()->fiyat ?? 0,
                        'katki_farki' => $fiyat->first()->katki_farki ?? 0,
                        'artis' => $fiyat->first()->artis ?? 0,
                        'azalis' => $fiyat->first()->azalis ?? 0,
                        'pb' => $fiyat->first()->pb ?? 0,
                    ];  
            }
        }

        // Güncellenen veriyi yanıt olarak döndür
        return response()->json($veriler);
    }
}
