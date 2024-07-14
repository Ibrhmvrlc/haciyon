<?php

namespace App\Http\Controllers;

use App\Models\Pompacilar;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProgramController extends Controller
{
    public function index(){
        $title = 'Program Yap';
        $events = Program::all();
        $pompacilar = Pompacilar::all();
        
        return view('pazarlama.do_program', compact('title', 'events', 'pompacilar'));
    }

    // Pompali program olustur
    public function storePompali(Request $request, $id){ 
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $time = $request->input('start');
            $tarih = $request->input('tarihPompa' . $id);
            
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
    public function storeMikserli(Request $request){ 
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $validated = $request->validate([
                // 'start' => 'required|date_format:Y-m-d\TH:i:s', !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                'title' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
                'santiye' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'yapi_elemani' => 'required|string|max:255',
            ]);

            $program = new Program();
            $program->pompaci_id = '0';
            $program->baslangic_saati = now(); //DUZELT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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
    public function storeSantralAlti(Request $request){ 
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $validated = $request->validate([
                // 'start' => 'required|date_format:Y-m-d\TH:i:s', !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                'title' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
                'santiye' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'yapi_elemani' => 'required|string|max:255',
            ]);

            $program = new Program();
            $program->pompaci_id = '0';
            $program->baslangic_saati = now(); //DUZELT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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


















    public function onDropstore(Request $request){
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $validated = $request->validate([
                'start' => 'required|date_format:Y-m-d\TH:i:s',
                'end' => 'nullable|date_format:Y-m-d\TH:i:s',
                'className' => 'nullable|string',
                'className' => 'nullable|string',
            ]);
    
            $program = Program::create([
                'pompaci' => 'saban kaya',
                'baslangic_saati' => $validated['start'],
                'bitis_saati' => Carbon::parse($validated['end'])->addHours(2),
                'musteri_adi' => null,
                'dokum_sekli' => $validated['className'],
                'santiye' => 'karamursel',
                'metraj' => '35',
                'yapi_elemani' => 'kolon',
                'odeme_bilgisi' => 'ay basi'
            ]);


            return response()->json($program, 201);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request){
        if(auth()->check()){
            $validated = $request->validate([
                'id' => 'required|exists:programs,id',
                'title' => 'required|string|max:255',
                'start' => 'required|date_format:Y-m-d\TH:i:s',
                'end' => 'nullable|date_format:Y-m-d\TH:i:s',
                'className' => 'nullable|string',
            ]);


            $program = Program::findOrFail($validated['id']);
            $program->baslangic_saati = $validated['start'];
            $program->bitis_saati = $validated['end'];
            $program->musteri_adi = $validated['title'];
            $program->dokum_sekli = $validated['className'];
            $program->save();

            return response()->json($program, 201);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function updateDrag(Request $request){
        if(auth()->check()){
            $validated = $request->validate([
                'id' => 'required|integer',
                'start' => 'required|date_format:Y-m-d\TH:i:s',
                'end' => 'nullable|date_format:Y-m-d\TH:i:s'
            ]);

            $program = Program::findOrFail($validated['id']);
            $program->baslangic_saati = $validated['start'];
            $program->bitis_saati = $validated['end'];
            $program->save();

            return response()->json($program, 201);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

}