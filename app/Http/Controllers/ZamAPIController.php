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
}
