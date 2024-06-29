<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;

class PazarlamaController extends Controller
{
    public function programSayfasi(){
        $title = 'Program Yap';

        return view('pazarlama.do_program', compact('title'));
    }

    public function createProgram(Request $request){
        if(auth()->check()){
            $user =  User::findOrFail(auth()->id());

            $program = New Program();
            $program->Musteri_Adi = $request->input('title');
            $program->Dokum_Sekli = $request->input('category');
            $program->save();

            
        }else{
            return redirect()->route('login');
        }
    }
}
