<?php

namespace App\Http\Controllers;

use App\Models\AktifMusteriler;
use App\Models\AktifMusteriSantiye;
use App\Models\AktifMusteriYetkililer;
use App\Models\AktifSantiyeFiyat;
use App\Models\Musteri;
use App\Models\MusteriNotlari;
use App\Models\Tur;
use Illuminate\Http\Request;


use function PHPUnit\Framework\isEmpty;

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
        $fatura_bilgileri->vergi_dairesi = $request->input('VD');
        $fatura_bilgileri->vergi_numarasi = $request->input('VNTCN');
        $fatura_bilgileri->mail = $request->input('email');
        $fatura_bilgileri->tel = $request->input('tel');
        $fatura_bilgileri->save();

        return redirect()->back();
    }

    public function iletisimBilgileriGuncelle(Request $request, $id){
        $iletisim_bilgileri = AktifMusteriYetkililer::where('aktif_musteri_id', $id)->get();

        foreach($iletisim_bilgileri as $bilgiler){
            if( $bilgiler->adi_soyadi != $request->input('yet' . $bilgiler->id . 'AdSoyad') or
            $bilgiler->tel != $request->input('yet' . $bilgiler->id . 'Tel') or
            $bilgiler->mail != $request->input('yet' . $bilgiler->id . 'Mail')){
                $bilgiler->adi_soyadi = $request->input('yet' . $bilgiler->id . 'AdSoyad');
                $bilgiler->tel = $request->input('yet' . $bilgiler->id . 'Tel');
                $bilgiler->mail = $request->input('yet' . $bilgiler->id . 'Mail');
                $bilgiler->save();
            }
        }

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
        $kontrol = AktifMusteriYetkililer::where('aktif_musteri_id', $id)->
        where('adi_soyadi', $request->input('yeni_adSoyad'))->
        where('tel', $request->input('yeni_tel'))->
        where('mail', $request->input('yeni_mail'))->get();

        if(isEmpty($kontrol)){
            $yetkili = new AktifMusteriYetkililer();
            $yetkili->aktif_musteri_id = $id;
            $yetkili->adi_soyadi = mb_strtoupper($request->input('yeni_adSoyad'), 'UTF-8');
            $yetkili->tel = $request->input('yeni_tel');
            $yetkili->mail =$request->input('yeni_mail');
            $yetkili->save();   
        }else{
            return redirect()->back()->withErrors('Bu yetkili daha önce eklenmiş.');
        }
       
        return redirect()->back();
    }

    public function yetkiliSil($id){
        $sil = AktifMusteriYetkililer::findOrFail($id);
        $sil->delete();
        
        return redirect()->back();
    }

    public function updatePage(){
        $title = 'Fiyat Listesi';
       
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

        return view('musteri.fiyat.fiyat_listesi', compact('veriler', 'title'));
    }

    public function bildirimGit(){
        $title = 'Bildirim Listesi';
        $turler = Tur::all();
        $musteriler = AktifMusteriler::all();

        return view('musteri.fiyat.bildirim_listesi', compact('title', 'turler', 'musteriler'));
    }

    public function filter(Request $request)
    {
        $turs = Tur::all();

        foreach($turs as $tur) {
            $filter = $request->input('tur' . $tur->id .'');

            if (empty($filter)) {
              // ERROR
            } else {
                $musteriler = AktifMusteriler::whereIn('tur', $filter)->get();
            }




        }







       
        
        // Verileri JSON olarak döndür
        return response()->json($musteriler);
    }
}