<?php

use App\Http\Controllers\PazarlamaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/program')->group(function(){
    Route::get('/program-yap', [PazarlamaController::class, 'programSayfasi'])->name('program.yap.git');
    Route::get('/eski-programlar', [PazarlamaController::class, ''])->name('');
    Route::post('/olustur', [PazarlamaController::class, 'createProgram'])->name('Program.olustur');
});