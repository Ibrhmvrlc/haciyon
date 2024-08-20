<?php

namespace App\Http\Controllers;

use App\Models\AktifMusteriler;
use App\Models\AktifMusteriSantiye;
use App\Models\AktifMusteriYetkililer;
use App\Models\AktifSantiyeFiyat;
use App\Models\AktifSantiyeMetraj;
use App\Models\Musteri;
use App\Models\MusteriNotlari;
use Illuminate\Http\Request;

class MusteriController extends Controller
{
    public function index() {
       $title = 'Tüm Müşteriler';
       $musteriler = Musteri::all();
        
        return view('musteri.tum_musteriler', compact('title', 'musteriler'));
    }

    public function aktifIndex() {
        $title = 'Aktif Müşteriler';
        $aktif_musteriler = AktifMusteriler::all();
        $aktif_musteri_fiyat = AktifSantiyeFiyat::all();
         
        return view('musteri.aktif_musteri', compact('title', 'aktif_musteriler', 'aktif_musteri_fiyat'));
    }

    public function aktifProfile($id) {
        $aktif_musteri = AktifMusteriler::findOrFail($id);
        $title = $aktif_musteri->unvan;
        $notes = MusteriNotlari::where('musteri_id', $id)->where('tamamlandi', false)->get();
        $tamamlanan_notlar = MusteriNotlari::where('musteri_id', $id)->where('tamamlandi', true)->get();
        $aktif_santiye = AktifMusteriSantiye::where('aktif_musteri_id', $id)->get();
        $fiyatlar = AktifSantiyeFiyat::where('aktif_musteri_id', $id)->get();
        $yetkililer = AktifMusteriYetkililer::where('aktif_musteri_id', $id)->get();

        return view('musteri.aktif_profil', compact(
            'title', 'aktif_musteri', 'notes', 'tamamlanan_notlar', 'aktif_santiye', 'fiyatlar', 'yetkililer'
        ));
    }

    public function profile($id) {
        $musteri = Musteri::findOrFail($id);
        $title = 'Müşteri - ' . $musteri->unvani;
        $notes = MusteriNotlari::where('musteri_id', $id)->where('tamamlandi', false)->get();
        $tamamlanan_notlar = MusteriNotlari::where('musteri_id', $id)->where('tamamlandi', true)->get();
         
        return view('musteri.musteri_profil', compact('title', 'musteri', 'notes', 'tamamlanan_notlar'));
    }

    public function addNote(Request $request, $id) {
        $validated = $request->validate([
            'baslik' => 'required|string|max:255',
            'not' => 'required|string|min:10|max:500',
        ]);

        if($request->input('hatirlaticiGun') AND $request->input('hatirlaticiSaat')){
            $hatirlatici = $request->input('hatirlaticiGun') . ' ' . $request->input('hatirlaticiSaat');
        } else {
            $hatirlatici = '1111-11-11 11:11:11';
        }

        $not = new MusteriNotlari();
        $not->musteri_id = $id;
        $not->baslik = mb_strtoupper($validated['baslik'], 'UTF-8');
        $not->not = $validated['not'];
        $not->hatirlatici = $hatirlatici;
        $not->save();

        return redirect()->back();
    }

    public function update($id) {
        $completedNote = MusteriNotlari::findOrFail($id);
        $completedNote->tamamlandi = true;
        $completedNote->save();

        return redirect()->back();
    }

    public function santiyeFiyatGuncelle(Request $request, $id){
        $fiyatlar = AktifSantiyeFiyat::where('aktif_musteri_id', $id)->get();

        foreach($fiyatlar as $fiyat) {
            if(
                $fiyat->beton_sinifi != $request->input('santiye_' . $fiyat->id . '_bs') OR
                $fiyat->fiyat != $request->input('santiye_' . $fiyat->id . '_fiyat') OR
                $fiyat->pb != $request->input('santiye_' . $fiyat->id . '_pb') OR
                $fiyat->pb_siniri != $request->input('santiye_' . $fiyat->id . '_pbsiniri') OR
                $fiyat->katki_farki != $request->input('santiye_' . $fiyat->id . '_katki') OR
                $fiyat->ozel_farki != $request->input('santiye_' . $fiyat->id . '_ozel') OR
                $fiyat->artis != $request->input('santiye_' . $fiyat->id . '_artis') OR
                $fiyat->azalis != $request->input('santiye_' . $fiyat->id . '_azalis')
                ){
                $fiyat->beton_sinifi = $request->input('santiye_' . $fiyat->id . '_bs');
                $fiyat->fiyat = $request->input('santiye_' . $fiyat->id . '_fiyat');
                $fiyat->pb = $request->input('santiye_' . $fiyat->id . '_pb');
                $fiyat->pb_siniri = $request->input('santiye_' . $fiyat->id . '_pbsiniri');
                $fiyat->katki_farki = $request->input('santiye_' . $fiyat->id . '_katki');
                $fiyat->ozel_farki = $request->input('santiye_' . $fiyat->id . '_ozel');
                $fiyat->artis = $request->input('santiye_' . $fiyat->id . '_artis');
                $fiyat->azalis = $request->input('santiye_' . $fiyat->id . '_azalis');
                $fiyat->save();
            }
        }

        return redirect()->back();
    }

    public function faturaBilgileriGuncelle(Request $request, $id){
        $fatura_bilgileri = AktifMusteriler::findOrFail($id);
        $fatura_bilgileri->unvan = $request->input('unvani');
        $fatura_bilgileri->fatura_adresi = $request->input('fAdresi');
        $fatura_bilgileri->semt = $request->input('semt');
        $fatura_bilgileri->kent = $request->input('kent');
        $fatura_bilgileri->posta_kodu = $request->input('postaKodu');
        $fatura_bilgileri->mail = $request->input('email');
        $fatura_bilgileri->vergi_dairesi = $request->input('VD');
        $fatura_bilgileri->vergi_numarasi = $request->input('VNTCN');
        $fatura_bilgileri->save();

        return redirect()->back();
    }

    public function iletisimBilgileriGuncelle(Request $request, $id){
        $iletisim_bilgileri = AktifMusteriler::findOrFail($id);
        $iletisim_bilgileri->yetkili_bir = $request->input('birAdSoyad');
        $iletisim_bilgileri->yetkili_bir_tel = $request->input('birTel');
        $iletisim_bilgileri->yetkili_bir_mail = $request->input('birMail');
        $iletisim_bilgileri->yetkili_iki = $request->input('ikiAdSoyad');
        $iletisim_bilgileri->yetkili_iki_tel = $request->input('ikiTel');
        $iletisim_bilgileri->yetkili_iki_mail = $request->input('ikiMail');
        $iletisim_bilgileri->save();

        return redirect()->back();
    }

    public function yeniSantiyeEkle(Request $request, $id) {
        $kontrol = AktifMusteriSantiye::where('aktif_musteri_id', $id)->where('santiye', $request->input('yeni_santiye'))->get();
        
        if(mb_strtoupper($request->input('yeni_santiye'), 'UTF-8') != isset($kontrol->first()->santiye)){
            $santiye = new AktifMusteriSantiye();
            $santiye->aktif_musteri_id = $id;
            $santiye_adi = mb_strtoupper($request->input('yeni_santiye'), 'UTF-8');
            $santiye->santiye = $santiye_adi;
            $santiye->save();
    
            $santiyeId = AktifMusteriSantiye::where('aktif_musteri_id', $id)->where('santiye', $request->input('yeni_santiye'))->get();
    
            $fiyat = new AktifSantiyeFiyat();
            $fiyat->aktif_musteri_id = $id;
            $fiyat->santiye_id = $santiyeId->first()->id;
            $fiyat->beton_sinifi = $request->input('yeni_santiye_bs');
            $fiyat->fiyat = $request->input('yeni_santiye_fiyat');
            $fiyat->katki_farki = $request->input('yeni_santiye_katki');
            $fiyat->ozel_farki = $request->input('yeni_santiye_ozel');
            $fiyat->artis = $request->input('yeni_santiye_artis');
            $fiyat->azalis = $request->input('yeni_santiye_azalis');
            // $fiyat->pb = $request->input('yeni_santiye_pb'); EKLE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $fiyat->save();    
        }else{
            return redirect()->back()->withErrors('Bu Şantiye daha önceden eklenmiş.');
        }
       
        return redirect()->back();
    }

    public function yetkiliEkle(Request $request, $id){
        $iletisim_bilgileri = AktifMusteriler::findOrFail($id);

        if($iletisim_bilgileri->yetkili_bir == null OR $iletisim_bilgileri->yetkili_bir == ''){
            $iletisim_bilgileri->yetkili_bir = $request->input('yeni_adSoyad');
            $iletisim_bilgileri->yetkili_bir_tel = $request->input('yeni_tel');
            $iletisim_bilgileri->yetkili_bir_mail = $request->input('yeni_mail');
        }elseif($iletisim_bilgileri->yetkili_iki == null OR $iletisim_bilgileri->yetkili_iki == ''){
            $iletisim_bilgileri->yetkili_iki = $request->input('yeni_adSoyad');
            $iletisim_bilgileri->yetkili_iki_tel = $request->input('yeni_tel');
            $iletisim_bilgileri->yetkili_iki_mail = $request->input('yeni_mail');
        }else{
            return redirect()->back()->with('error', 'Yetkili limiti dolmuştur.');
        }
        $iletisim_bilgileri->save();

        return redirect()->back();
    }

    public function fiyatListesiIndex(){
        $title = 'Fiyat Listesi';

        return view('musteri.fiyat_listesi', compact('title'));
    }


}
