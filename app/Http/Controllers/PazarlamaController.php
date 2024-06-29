<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PazarlamaController extends Controller
{
    public function programSayfasi(){
        $title = 'Program Yap';

        return view('pazarlama.do_program', compact('title'));
    }
}
