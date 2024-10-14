<?php

namespace App\Http\Controllers;

use App\Models\AktifMusteriler;
use App\Models\AktifMusteriSantiye;
use App\Models\AktifMusteriYetkililer;
use App\Models\AktifSantiyeFiyat;
use App\Models\FiyatGuncellemeBildirim;
use App\Models\Musteri;
use App\Models\MusteriNotlari;
use App\Models\Tur;
use App\Models\Urunler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;


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

    public function musteriTuru(){
        $title = 'Müşteri Türü';
        $turler = Tur::all();
        $musteriler = AktifMusteriler::all();

        return view('musteri.fiyat.bildirim_musteri_turu', compact('title', 'turler', 'musteriler'));
    }

    public function gonderimSekli(){
        $title = 'Gönderim Şekli';
        $turler = Tur::all();
        $musteriler = AktifMusteriler::all();

        return view('musteri.fiyat.bildirim_gonderim_sekli', compact('title', 'turler', 'musteriler'));
    }

    public function onizleme(){
        $title = 'Önizleme';
        $turler = Tur::all();
        $musteriler = FiyatGuncellemeBildirim::where('bildirim_olacak_mi', true)->get();
        $urunler = Urunler::all();

        return view('musteri.fiyat.bildirim_onizleme', compact('title', 'turler', 'musteriler', 'urunler'));
    }

    public function onay(){
        $title = 'Onay';
        $turler = Tur::all();
        $musteriler = FiyatGuncellemeBildirim::where('bildirim_olacak_mi', true)->get();

        return view('musteri.fiyat.bildirim_onay', compact('title', 'turler', 'musteriler'));
    }

    public function filter(Request $request){
        $selectedTurs = $request->input('checkboxes', []);

        if (!empty($selectedTurs)) {
            $musteriler = AktifMusteriler::whereIn('turs', $selectedTurs)->get();

            return response()->json($musteriler);
        } else {
            return response()->json(['message' => 'Hiçbir checkbox işaretlenmedi.']);
        }
    }

    public function ilkAdimForm(Request $request){
        // Bildirim tablosunu sıfırlıyoruz
        DB::table('fiyat_guncelleme_bildirims')->truncate();

        // Checkboxlardan seçilen müşteri türlerini alıyoruz
        $selectedTurler = $request->input('checkboxes');

        // Select'ten secilen istisna musterileri aliyoruz
        $istisnaMusteriler = $request->input('musteriler');

        if ($selectedTurler) {
            // Seçilen türlere ait müşterileri alıyoruz
            $musteriler = AktifMusteriler::whereIn('turs', $selectedTurler)->get();

            if ($musteriler->isNotEmpty()) {
                // Bildirim tablosunu her müşteri için oluşturmaya başlıyoruz
                foreach ($musteriler as $musteri) {
                    // Eğer müşteri istisna listesinde yer alıyorsa 'bildirim_olacak_mi' false olacak
                    $isIstisna = !empty($istisnaMusteriler) && in_array($musteri->id, $istisnaMusteriler);

                    if(substr($musteri->tel, 0, 2) == '05'){
                        $musteriTel = $musteri->tel;
                    }else{
                        $musteriTel = '';
                    }

                    // Bildirim kaydını yapıyoruz
                    FiyatGuncellemeBildirim::create([
                        'musteri_id' => $musteri->id,
                        'musteri_unvani' => $musteri->unvan,
                        'tur' => $musteri->turs,
                        'tel' => $musteriTel,
                        'eposta' => $musteri->mail,
                        'bildirim_olacak_mi' => !$isIstisna, // İstisna olanlar false, diğerleri true
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                
                // Başarıyla işlem tamamlandıktan sonra ikinci adıma yönlendiriyoruz
                return redirect()->route('bildirim.gonderim.sekli')->with('success', 'İlk adım başarıyla tamamlandı, lütfen ikinci adımı doldurunuz.');
            } else {
                return redirect()->back()->with('error', 'Seçilen türler için müşteri bulunamadı.');
            }
        } else {
            return redirect()->back()->with('error', 'Hiçbir tür seçilmedi.');
        }
    }

    public function ikinciAdimForm(Request $request){
        $turler = Tur::all();
        $urunler = Urunler::all();
        // Validasyon
        $request->validate([
            'bildirimSekli' => 'required|string',
            'bildirimTarih' => 'required|date',
        ]);
    
        $bildirim_sekli = $request->input('bildirimSekli');
        $bildirim_tarihi = $request->input('bildirimTarih');
    
       // bildirim_olacak_mi sütunu 1 olan kayıtları güncelle
        FiyatGuncellemeBildirim::where('bildirim_olacak_mi', true)->update([
            'bildirim_sekli' => $bildirim_sekli,
            'tarih' => $bildirim_tarihi,
        ]);

        // Oturumda sakla
        session([
            'bildirim_sekli' => $bildirim_sekli,
            'bildirim_tarihi' => $bildirim_tarihi,
        ]);

        $musteriler = FiyatGuncellemeBildirim::where('bildirim_olacak_mi', true)->get();
        $eksikTelefonlar = []; // Eksik telefon bilgisi olan müşteriler için dizi
        $eksikEpostalar = []; // Eksik e-posta bilgisi olan müşteriler için dizi

        foreach($musteriler as $musteri){
            if($musteri->musteri_unvani){
                $epostalar_yet = AktifMusteriYetkililer::where('aktif_musteri_id', $musteri->musteri_id)->get();
                $epostalar_must = AktifMusteriler::where('id', $musteri->musteri_id)->get();
                $teller_yet = AktifMusteriYetkililer::where('aktif_musteri_id', $musteri->musteri_id)->get();
                $teller_must = AktifMusteriler::where('id', $musteri->musteri_id)->get();

                $hasValidTels = false;
                $hasValidEmails = false;

                // Telefon kontrolü (Yetkililer)
                foreach($teller_yet as $tel){
                    if(!empty($tel->tel) && substr($tel->tel, 0, 2) == '05'){
                        $hasValidTels = true;
                        break;
                    }
                }

                // Telefon kontrolü (Müşteriler)
                if(!$hasValidTels){
                    foreach($teller_must as $tel){
                        if(!empty($tel->tel) && substr($tel->tel, 0, 2) == '05'){
                            $hasValidTels = true;
                            break;
                        }
                    }
                }

                // E-posta kontrolü (Yetkililer)
                foreach($epostalar_yet as $eposta){
                    if(!empty($eposta->mail) && filter_var($eposta->mail, FILTER_VALIDATE_EMAIL)){
                        $hasValidEmails = true;
                        break;
                    }
                }

                // E-posta kontrolü (Müşteriler)
                if(!$hasValidEmails){
                    foreach($epostalar_must as $eposta){
                        if(!empty($eposta->mail) && filter_var($eposta->mail, FILTER_VALIDATE_EMAIL)){
                            $hasValidEmails = true;
                            break;
                        }
                    }
                }

                // Eksik telefon bilgisi varsa, müşteri unvanını listeye ekle
                if(!$hasValidTels){
                    $eksikTelefonlar[] = $musteri->musteri_unvani;
                }

                // Eksik e-posta bilgisi varsa, müşteri unvanını listeye ekle
                if(!$hasValidEmails){
                    $eksikEpostalar[] = $musteri->musteri_unvani;
                }
            }
        }

        // Eğer eksik telefon ya da e-posta bilgisi olan müşteriler varsa, session ile yönlendir
        if(!empty($eksikTelefonlar) || !empty($eksikEpostalar)){
            return redirect()->route('bildirim.musteri.turu')
                ->with('telefon_error', $eksikTelefonlar) // Telefon eksikliklerini gönder
                ->with('eposta_error', $eksikEpostalar); // E-posta eksikliklerini gönder
        }


        // Başarıyla işlem tamamlandıktan sonra ikinci adıma yönlendiriyoruz
        return redirect()->route('bildirim.onizleme');
    }

    public function ucuncuAdim(Request $request){
        $bildirim_yapilacaklar = FiyatGuncellemeBildirim::where('bildirim_olacak_mi', true)->get();
        $secilen_epostalar = $request->input('epostalar', []);
        $secilen_teller = $request->input('teller', []);
        $secilen_tarih = $request->input('bildirimTarih', []);
        $tarihicin_secilen_id = $request->input('bildirimId', []);
        $secilen_sinir_bs = $request->input('sinir_bs', []);
        $sinirbs_secilen_id = $request->input('sinirBSBildirimId', []);
    
        if(!empty($secilen_epostalar)) {
            foreach ($secilen_epostalar as $eposta) {
                // $selected formatı: musteri_id_email şeklinde olduğu için ayırıyoruz.
                [$musteri_id, $email] = explode('_', $eposta);
    
                // İlgili müşteri ve mail adresi zaten var mı kontrol et.
                $exists = DB::table('fiyat_guncelleme_bildirims')
                ->where('musteri_id', $musteri_id)
                ->where('eposta', $email)
                ->exists();
    
                // Eğer kayıt zaten yoksa tabloya ekle.
                if (!$exists) {
                        // Bildirim kaydını yapıyoruz
                        FiyatGuncellemeBildirim::create([
                        'musteri_id' => $musteri_id,
                        'eposta' => $email,
                        'bildirim_sekli' => 'eposta',
                        'bildirim_olacak_mi' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        } elseif(!empty($secilen_teller)) {
            foreach ($secilen_teller as $tel) {
                // $selected formatı: musteri_id_email şeklinde olduğu için ayırıyoruz.
                [$musteri_id, $tel] = explode('_', $tel);
    
                // İlgili müşteri ve mail adresi zaten var mı kontrol et.
                $exists = DB::table('fiyat_guncelleme_bildirims')
                ->where('musteri_id', $musteri_id)
                ->where('tel', $tel)
                ->exists();
    

                // İlgili müşteri var mı kontrol et.
                $kayit = DB::table('fiyat_guncelleme_bildirims')
                ->where('musteri_id', $musteri_id)
                ->first();

                if ($kayit) {
                    // Müşteri varsa ve tel sütunu boşsa güncelle
                    if (empty($kayit->tel)) {
                        DB::table('fiyat_guncelleme_bildirims')
                            ->where('id', $kayit->id)
                            ->update([
                                'tel' => $tel,
                                'updated_at' => now(),
                            ]);
                    }
                } elseif(!$exists) {
                    // Müşteri yoksa yeni bir kayıt oluştur
                    FiyatGuncellemeBildirim::create([
                        'musteri_id' => $musteri_id,
                        'tel' => $tel,
                        'bildirim_sekli' => 'wp',
                        'bildirim_olacak_mi' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        if (!empty($secilen_tarih) && !empty($tarihicin_secilen_id)) {
            foreach ($secilen_tarih as $index => $tarih) {
                $id = $tarihicin_secilen_id[$index]; // ID'yi aynı indeksten alıyoruz
                DB::table('fiyat_guncelleme_bildirims')
                    ->where('musteri_id', $id)
                    ->update([
                        'tarih' => $tarih,
                        'updated_at' => now(),
                    ]);
            }
        }

        if (!empty($secilen_sinir_bs)) {
            foreach ($secilen_sinir_bs as $index => $sinir_bs) {
                $id = $sinirbs_secilen_id[$index]; // ID'yi aynı indeksten alıyoruz
                DB::table('fiyat_guncelleme_bildirims')
                    ->where('musteri_id', $id)
                    ->update([
                        'sinir_bs' => $sinir_bs,
                        'updated_at' => now(),
                    ]);
            }
        }

        // Değişkenleri query string ile birlikte yönlendiriyoruz
        return redirect()->route('bildirim.onay');
    }

   
    public function bildirimForm()
    {
        $musteriler = FiyatGuncellemeBildirim::with('santiyeFiyatlar')->get();
        return view('musteri.fiyat.bildirim_onay', compact('musteriler'));
    }

    public function showPdf($musteri_id, $santiye_id) {
        // İlgili şantiye ve müşteri için fiyat bilgilerini çekiyoruz
        $fiyatlar = AktifSantiyeFiyat::where('aktif_musteri_id', $musteri_id)
                        ->where('santiye_id', $santiye_id)
                        ->get();

        if ($fiyatlar->isEmpty()) {
            abort(404, 'Fiyat bilgisi bulunamadı.');
        }
        $musteri = FiyatGuncellemeBildirim::where('musteri_id', $musteri_id)->get();
        $urunler = Urunler::all();

        // PDF taslağı için Blade view'ını kullanıyoruz
        $pdf = Pdf::loadView('musteri.fiyat.fiyat_taslagi', compact('fiyatlar', 'urunler', 'musteri'));

        // PDF'i yeni sekmede açmak için stream metodu
        return $pdf->stream('fiyat_guncelleme_yazisi.pdf');
    }

 /*
    public function bildirimGonder(Request $request)
    {
        $musteri = AktifMusteriler::with('santiyeFiyatlar')->find($request->musteri_id);

        // PDF oluşturma
        $pdf = PDF::loadView('pdf.fiyat_bildirim', ['musteri' => $musteri]);

        switch ($request->bildirim_tipi) {
            case 'mail':
                // Mail ile gönderim
               // Mail::send([], [], function($message) use ($pdf, $musteri) {
               //     $message->to($musteri->email)
                //        ->subject('Fiyat Güncelleme Bildirimi')
                //        ->attachData($pdf->output(), "fiyat_bildirim.pdf");
               // });
               // return back()->with('success', 'Mail başarıyla gönderildi.');
                
                return back()->with('success', 'Mail ayarları riskli'); // Ayar yapıp silinecek
            case 'whatsapp':
                // WhatsApp mesajı ile bildirim (3. parti hizmetler ile)
                $this->whatsappBildirim($musteri, $pdf);
                return back()->with('success', 'WhatsApp bildirimi gönderildi.');
                
            case 'indir':
                // PDF indir
                return $pdf->download('fiyat_bildirim.pdf');
        }
    }

    private function whatsappBildirim($musteri, $pdf)
    {
        // WhatsApp API entegrasyonu (örn: Twilio, WhatsApp Business API)
        // Burada örnek bir entegrasyon bulunmamaktadır
    }
    */
}