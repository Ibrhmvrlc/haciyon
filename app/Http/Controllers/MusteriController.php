<?php

namespace App\Http\Controllers;

use App\Models\AktifMusteriler;
use App\Models\AktifMusteriSantiye;
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
         
        return view('musteri.aktif_musteri', compact('title', 'aktif_musteriler'));
    }

    public function aktifProfile($id) {
        $aktif_musteri = AktifMusteriler::findOrFail($id);
        $title = $aktif_musteri->unvan;
        $notes = MusteriNotlari::where('musteri_id', $id)->where('tamamlandi', false)->get();
        $tamamlanan_notlar = MusteriNotlari::where('musteri_id', $id)->where('tamamlandi', true)->get();
        $aktif_santiye = AktifMusteriSantiye::where('aktif_musteri_id', $id)->get();
        $metraj = AktifSantiyeMetraj::where('aktif_santiye_id', $id)->get();
         
        return view('musteri.aktif_profil', compact(
            'title', 'aktif_musteri', 'notes', 'tamamlanan_notlar', 'aktif_santiye', 'metraj'
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
        $santiye = AktifMusteriSantiye::where('aktif_musteri_id', $id)->firstOrFail();
        $santiye->santiye_bir = $request->input('santiye_bir');
        if($request->input('santiye_iki')){
            $santiye->santiye_iki = $request->input('santiye_iki');
        }

        if($request->input('santiye_uc')){
            $santiye->santiye_uc = $request->input('santiye_uc');
        }
        if($request->input('santiye_dort')){
            $santiye->santiye_dort = $request->input('santiye_dort');
        }
        if($request->input('santiye_bes')){
            $santiye->santiye_bes = $request->input('santiye_bes');
        }
        if($request->input('santiye_alti')){
            $santiye->santiye_alti = $request->input('santiye_alti');
        }
        if($request->input('santiye_yedi')){
            $santiye->santiye_yedi = $request->input('santiye_yedi');
        }
        if($request->input('santiye_sekiz')){
            $santiye->santiye_sekiz = $request->input('santiye_sekiz');
        }
        if($request->input('santiye_dokuz')){
            $santiye->santiye_dokuz = $request->input('santiye_dokuz');
        }
        if($request->input('santiye_on')){
            $santiye->santiye_on = $request->input('santiye_on');
        }
        if($request->input('santiye_onbir')){
            $santiye->santiye_onbir = $request->input('santiye_onbir');
        }
        if($request->input('santiye_oniki')){
            $santiye->santiye_oniki = $request->input('santiye_oniki');
        }
        if($request->input('santiye_onuc')){
            $santiye->santiye_onuc = $request->input('santiye_onuc');
        }
        if($request->input('santiye_ondort')){
            $santiye->santiye_ondort = $request->input('santiye_ondort');
        }
        if($request->input('santiye_onbes')){
            $santiye->santiye_onbes = $request->input('santiye_onbes');
        }
        if($request->input('santiye_onalti')){
            $santiye->santiye_onalti = $request->input('santiye_onalti');
        }
        if($request->input('santiye_onyedi')){
            $santiye->santiye_onyedi = $request->input('santiye_onyedi');
        }
        $santiye->save();

        $fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $id)->first();
       
        if ($fiyat === null) {
             // Varsayılan değerler
             $fiyat = new AktifSantiyeFiyat();
             $fiyat->aktif_santiye_id = $id;
             $fiyat->santiye_bir_fiyat = 0;
             $fiyat->santiye_iki_fiyat = 0; 
             $fiyat->santiye_uc_fiyat = 0;
             $fiyat->santiye_dort_fiyat = 0;
             $fiyat->santiye_bes_fiyat = 0;
             $fiyat->santiye_alti_fiyat = 0;
             $fiyat->santiye_yedi_fiyat = 0;
             $fiyat->santiye_sekiz_fiyat = 0;
             $fiyat->santiye_dokuz_fiyat = 0;
             $fiyat->santiye_on_fiyat = 0;
             $fiyat->santiye_onbir_fiyat = 0;
             $fiyat->santiye_oniki_fiyat = 0;
             $fiyat->santiye_onuc_fiyat = 0;
             $fiyat->santiye_ondort_fiyat = 0;
             $fiyat->santiye_onbes_fiyat = 0;
             $fiyat->santiye_onalti_fiyat = 0;
             $fiyat->santiye_onyedi_fiyat = 0;
             $fiyat->save(); // Yeni kaydı veritabanına kaydet
        }
            $fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $id)->first();
            $fiyat->santiye_bir_fiyat = $request->input('santiye_bir_fiyat');
            $fiyat->santiye_iki_fiyat = $request->input('santiye_iki_fiyat');
            $fiyat->santiye_uc_fiyat = $request->input('santiye_uc_fiyat');
            $fiyat->santiye_dort_fiyat = $request->input('santiye_dort_fiyat');
            $fiyat->santiye_bes_fiyat = $request->input('santiye_bes_fiyat');
            $fiyat->santiye_alti_fiyat = $request->input('santiye_alti_fiyat');
            $fiyat->santiye_yedi_fiyat = $request->input('santiye_yedi_fiyat');
            $fiyat->santiye_sekiz_fiyat = $request->input('santiye_sekiz_fiyat');
            $fiyat->santiye_dokuz_fiyat = $request->input('santiye_dokuz_fiyat');
            $fiyat->santiye_on_fiyat = $request->input('santiye_on_fiyat');
            $fiyat->santiye_onbir_fiyat = $request->input('santiye_onbir_fiyat');
            $fiyat->santiye_oniki_fiyat = $request->input('santiye_oniki_fiyat');
            $fiyat->santiye_onuc_fiyat = $request->input('santiye_onuc_fiyat');
            $fiyat->santiye_ondort_fiyat = $request->input('santiye_ondort_fiyat');
            $fiyat->santiye_onbes_fiyat = $request->input('santiye_onbes_fiyat');
            $fiyat->santiye_onalti_fiyat = $request->input('santiye_onalti_fiyat');
            $fiyat->santiye_onyedi_fiyat = $request->input('santiye_onyedi_fiyat');
            $fiyat->save();

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
        $santiye = AktifMusteriSantiye::where('aktif_musteri_id', $id)->first();
        $fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $id)->first();

        if($fiyat === null) {
            // Varsayılan değerler
            $fiyat = new AktifSantiyeFiyat();
            $fiyat->aktif_santiye_id = $id;
            $fiyat->santiye_bir_fiyat = 0;
            $fiyat->santiye_iki_fiyat = 0; 
            $fiyat->santiye_uc_fiyat = 0;
            $fiyat->santiye_dort_fiyat = 0;
            $fiyat->santiye_bes_fiyat = 0;
            $fiyat->santiye_alti_fiyat = 0;
            $fiyat->santiye_yedi_fiyat = 0;
            $fiyat->santiye_sekiz_fiyat = 0;
            $fiyat->santiye_dokuz_fiyat = 0;
            $fiyat->santiye_on_fiyat = 0;
            $fiyat->santiye_onbir_fiyat = 0;
            $fiyat->santiye_oniki_fiyat = 0;
            $fiyat->santiye_onuc_fiyat = 0;
            $fiyat->santiye_ondort_fiyat = 0;
            $fiyat->santiye_onbes_fiyat = 0;
            $fiyat->santiye_onalti_fiyat = 0;
            $fiyat->santiye_onyedi_fiyat = 0;
            $fiyat->save(); // Yeni kaydı veritabanına kaydet
       }

        if(($santiye->santiye_bir === null) OR ($santiye->santiye_bir == '')){
            $santiye->santiye_bir = $request->input('yeni_santiye');
            $fiyat->santiye_bir_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_iki == null) OR ($santiye->santiye_iki == '')){
            $santiye->santiye_iki = $request->input('yeni_santiye');
            $fiyat->santiye_iki_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_uc == null) OR ($santiye->santiye_uc == '')){
            $santiye->santiye_uc = $request->input('yeni_santiye');
            $fiyat->santiye_uc_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_dort == null) OR ($santiye->santiye_dort == '')){
            $santiye->santiye_dort = $request->input('yeni_santiye');
            $fiyat->santiye_dort_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_bes == null) OR ($santiye->santiye_bes == '')){
            $santiye->santiye_bes = $request->input('yeni_santiye');
            $fiyat->santiye_bes_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_alti == null) OR ($santiye->santiye_alti == '')){
            $santiye->santiye_alti = $request->input('yeni_santiye');
            $fiyat->santiye_alti_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_yedi == null) OR ($santiye->santiye_yedi == '')){
            $santiye->santiye_yedi = $request->input('yeni_santiye');
            $fiyat->santiye_yedi_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_sekiz == null) OR ($santiye->santiye_sekiz == '')){
            $santiye->santiye_sekiz = $request->input('yeni_santiye');
            $fiyat->santiye_sekiz_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_dokuz == null) OR ($santiye->santiye_dokuz == '')){
            $santiye->santiye_dokuz = $request->input('yeni_santiye');
            $fiyat->santiye_dokuz_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_on == null) OR ($santiye->santiye_on == '')){
            $santiye->santiye_on = $request->input('yeni_santiye');
            $fiyat->santiye_on_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_onbir == null) OR ($santiye->santiye_onbir == '')){
            $santiye->santiye_onbir = $request->input('yeni_santiye');
            $fiyat->santiye_onbir_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_oniki == null) OR ($santiye->santiye_oniki == '')){
            $santiye->santiye_oniki = $request->input('yeni_santiye');
            $fiyat->santiye_oniki_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_onuc == null) OR ($santiye->santiye_onuc == '')){
            $santiye->santiye_onuc = $request->input('yeni_santiye');
            $fiyat->santiye_onuc_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_ondort == null) OR ($santiye->santiye_ondort == '')){
            $santiye->santiye_ondort = $request->input('yeni_santiye');
            $fiyat->santiye_ondort_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_onbes == null) OR ($santiye->santiye_onbes == '')){
            $santiye->santiye_onbes = $request->input('yeni_santiye');
            $fiyat->santiye_onbes_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_onalti == null) OR ($santiye->santiye_onalti == '')){
            $santiye->santiye_onalti = $request->input('yeni_santiye');
            $fiyat->santiye_onalti_fiyat = $request->input('yeni_santiye_fiyat');
        } elseif(($santiye->santiye_onyedi == null) OR ($santiye->santiye_onyedi == '')){
            $santiye->santiye_onyedi = $request->input('yeni_santiye');
            $fiyat->santiye_onyedi_fiyat = $request->input('yeni_santiye_fiyat');
        }else{
            return redirect()->back()->with('error', 'Şantiye limiti dolmuştur.');
        }
        $santiye->save();
        $fiyat->save();

        return redirect()->back();
    }

    public function yekiliEkle(Request $request, $id){
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
}
