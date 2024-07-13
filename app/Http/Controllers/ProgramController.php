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

    public function store(Request $request){
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date_format:Y-m-d\TH:i:s',
                'end' => 'nullable|date_format:Y-m-d\TH:i:s',
                'className' => 'nullable|string',
                'pompaci' => 'nullable|string',
                'santiye' => 'required|string|max:255',
                'metraj' => 'required|integer|min:1',
                'yapi_elemani' => 'required|string|max:255',
                'beton_cinsi' => 'required|string|max:255',
            ]);
    
            $program = Program::create([
                'pompaci' => $validated['pompaci'],
                'baslangic_saati' => $validated['start'],
                'bitis_saati' => $validated['end'],
                'musteri_adi' => $validated['title'],
                'beton_cinsi' => $validated['beton_cinsi'],
                'dokum_sekli' => $validated['className'],
                'santiye' => $validated['santiye'],
                'metraj' => $validated['metraj'],
                'yapi_elemani' => $validated['yapi_elemani'],
                'odeme_bilgisi' => 'ay basi'
            ]);


            return response()->json($program, 201);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
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