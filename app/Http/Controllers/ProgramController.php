<?php

namespace App\Http\Controllers;

use App\Exports\ProgramsExport;
use App\Models\Pompacilar;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ProgramController extends Controller
{
    public function index($tarih) {
        setlocale(LC_TIME, 'tr_TR.UTF-8'); // Türkçe lokal ayarı
        $baslangic_saati = $tarih . ' 00:00:00';
        $bitis_saati = $tarih . ' 23:59:59';
        $title = 'Program Yap';
        $events = Program::all();
        $toplamMKup = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->sum('metraj');
        $pompaliMetraj = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->where('dokum_sekli', 'POMPALI')->sum('metraj');
        $pompaliAdet = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->where('dokum_sekli', 'POMPALI')->count();
        $mikserliMetraj = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->where('dokum_sekli', 'MİKSERLİ')->sum('metraj');
        $mikserliAdet = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->where('dokum_sekli', 'MİKSERLİ')->count();
        $santralAltiMetraj = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->where('dokum_sekli', 'SANTRAL ALTI')->sum('metraj');
        $santralAltiAdet = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->where('dokum_sekli', 'SANTRAL ALTI')->count();

        $pompacilar = Pompacilar::all();
        
        $carbonTarih = Carbon::parse($tarih);
       
        // Carbon'ın translatedFormat fonksiyonunu kullanarak Türkçe tarih formatla
        $carbonTarih->locale('tr');
        $formatli_tarih = $carbonTarih->translatedFormat('d F Y l');
        
        return view('pazarlama.do_program', compact('title', 'events', 'pompacilar', 'formatli_tarih', 'tarih', 
        'toplamMKup', 'pompaliMetraj', 'pompaliAdet', 'mikserliMetraj', 'mikserliAdet', 'santralAltiMetraj', 'santralAltiAdet'));
    }

    // Pompali program olustur
    public function storePompali(Request $request, $id, $tarih){ 
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $time = $request->input('start');
            
            // Tarihi ve zamanı birleştirerek Carbon objesi oluşturun
            $dateTimeString = $tarih . ' ' . $time;
            $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);
            
            // İstenen formatta string olarak alın
            $start = $dateTime->format('Y-m-d\TH:i:s');

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
                'santiye' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'yapi_elemani' => 'required|string|max:255',
            ]);

            $program = new Program();
            $program->pompaci_id = $id;
            $program->baslangic_saati = $start;
            $program->musteri_adi = mb_strtoupper($validated['title'], 'UTF-8');
            $program->beton_cinsi = mb_strtoupper($validated['beton_cinsi'], 'UTF-8');
            $program->dokum_sekli = 'POMPALI';
            $program->santiye = mb_strtoupper($validated['santiye'], 'UTF-8');
            $program->metraj = mb_strtoupper($validated['metraj'], 'UTF-8');
            $program->yapi_elemani = mb_strtoupper($validated['yapi_elemani'], 'UTF-8');
            $program->odeme_bilgisi = 'ay basi'; //DUZELT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $program->save();

            return redirect()->back();
        }else{
            return response()->json(['error' => 'Unauthorized'], 401); // GIRIS YAPINIZ SAYFASINA YONLENDIR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        }
    }

    // Mikserli program olustur
    public function storeMikserli(Request $request, $tarih){ 
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $time = $request->input('start');

            // Tarihi ve zamanı birleştirerek Carbon objesi oluşturun
            $dateTimeString = $tarih . ' ' . $time;
            $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);
             
            // İstenen formatta string olarak alın
            $start = $dateTime->format('Y-m-d\TH:i:s');

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
                'santiye' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'yapi_elemani' => 'required|string|max:255',
            ]);

            $program = new Program();
            $program->pompaci_id = '0';
            $program->baslangic_saati = $start;
            $program->musteri_adi = mb_strtoupper($validated['title'], 'UTF-8');
            $program->beton_cinsi = mb_strtoupper($validated['beton_cinsi'], 'UTF-8');
            $program->dokum_sekli = 'MİKSERLİ';
            $program->santiye = mb_strtoupper($validated['santiye'], 'UTF-8');
            $program->metraj = mb_strtoupper($validated['metraj'], 'UTF-8');
            $program->yapi_elemani = mb_strtoupper($validated['yapi_elemani'], 'UTF-8');
            $program->odeme_bilgisi = 'ay basi'; //DUZELT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $program->save();

            return redirect()->back();
        }else{
            return response()->json(['error' => 'Unauthorized'], 401); // GIRIS YAPINIZ SAYFASINA YONLENDIR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        }
    }

    // Santral Alti program olustur
    public function storeSantralAlti(Request $request, $tarih){ 
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $time = $request->input('start');

            // Tarihi ve zamanı birleştirerek Carbon objesi oluşturun
            $dateTimeString = $tarih . ' ' . $time;
            $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);
             
            // İstenen formatta string olarak alın
            $start = $dateTime->format('Y-m-d\TH:i:s');

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
                'santiye' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'yapi_elemani' => 'required|string|max:255',
            ]);

            $program = new Program();
            $program->pompaci_id = '0';
            $program->baslangic_saati = $start; //DUZELT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $program->musteri_adi = mb_strtoupper($validated['title'], 'UTF-8');
            $program->beton_cinsi = mb_strtoupper($validated['beton_cinsi'], 'UTF-8');
            $program->dokum_sekli = 'SANTRAL ALTI';
            $program->santiye = mb_strtoupper($validated['santiye'], 'UTF-8');
            $program->metraj = mb_strtoupper($validated['metraj'], 'UTF-8');
            $program->yapi_elemani = mb_strtoupper($validated['yapi_elemani'], 'UTF-8');
            $program->odeme_bilgisi = 'ay basi'; //DUZELT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $program->save();

            return redirect()->back();
        }else{
            return response()->json(['error' => 'Unauthorized'], 401); // GIRIS YAPINIZ SAYFASINA YONLENDIR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        }
    }

    public function update(Request $request, $id){
        if(auth()->check()){
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'santiye' => 'required|string|max:255',
                'yapi_elemani' => 'required|string|max:255',
            ]);

            $time = $request->input('start');
            $tarih = $request->input('tarihKismi');

            // Tarihi ve zamanı birleştirerek Carbon objesi oluşturun
            $dateTimeString = $tarih . ' ' . $time;
            $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);
              
            // İstenen formatta string olarak alın
            $startGuncellenmis = $dateTime->format('Y-m-d\TH:i:s');

            $program = Program::findOrFail($id);
            $program->baslangic_saati = $startGuncellenmis;
            $program->musteri_adi = mb_strtoupper($validated['title']);
            $program->beton_cinsi = mb_strtoupper($validated['beton_cinsi']);
            $program->metraj = mb_strtoupper($validated['metraj']);
            $program->santiye = mb_strtoupper($validated['santiye']);
            $program->yapi_elemani = mb_strtoupper($validated['yapi_elemani']);
            $program->save();

            return redirect()->back();
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function destroy($id) {
        $event = Program::findOrFail($id);
        $event->delete();
    
        return redirect()->back()->with('success', 'Öğe başarıyla silindi!');
    }

    public function export($tarih)
    {
        return Excel::download(new ProgramsExport($tarih), 'Taşköprü-Program-' . $tarih . '.xlsx');
    }
}