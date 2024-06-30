<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(){
        $title = 'Program Yap';

        return view('pazarlama.do_program', compact('title'));
    }

    public function store(Request $request){
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $program = New Program();
            $program->Musteri_Adi = $request->input('title');
            $program->Dokum_Sekli = $request->input('category');
            $program->baslangic_saati = $request->input('start');
            $program->baslangic_saati = $request->input('end');
            $program->save();


            return response()->json(['id' => $program->id]); // Yeni olay ID'sini döndürün
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request){
        if(auth()->check()){
            $program = Program::findOrFail($request->input('id'));
            $program->Musteri_Adi = $request->input('title');
            $program->Dokum_Sekli = $request->input('category');
            $program->baslangic_saati = $request->input('start');
            $program->bitis_saati = $request->input('end');
            $program->save();

            return response()->json(['success' => true]);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

}