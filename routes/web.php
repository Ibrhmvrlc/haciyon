<?php

use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/program')->group(function(){
    Route::get('/program-yap/{tarih}', [ProgramController::class, 'index'])->name('program.yap.git');
    Route::post('/create-pompali/{id}', [ProgramController::class, 'storePompali'])->name('program.olustur.pompali');
    Route::post('/create-mikserli', [ProgramController::class, 'storeMikserli'])->name('program.olustur.mikserli');
    Route::post('/create-santral-alti', [ProgramController::class, 'storeSantralAlti'])->name('program.olustur.santralalti');
    Route::get('/tarih-ileri/{tarih}', [ProgramController::class, 'tarihIleri'])->name('program.tarih.ileri');

    
    Route::get('/eski-programlar', [ProgramController::class, ''])->name('');
    Route::get('/events', [ProgramController::class, 'getEvents'])->name('programlari.goster');
    Route::post('/update', [ProgramController::class, 'update'])->name('programlar.guncelle');
    Route::post('/update-drag', [ProgramController::class, 'updateDrag'])->name('programlar.surukle.guncelle');
});