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
    Route::post('/create-pompali/{id}/{tarih}', [ProgramController::class, 'storePompali'])->name('program.olustur.pompali');
    Route::post('/create-mikserli/{tarih}', [ProgramController::class, 'storeMikserli'])->name('program.olustur.mikserli');
    Route::post('/create-santral-alti/{tarih}', [ProgramController::class, 'storeSantralAlti'])->name('program.olustur.santralalti');
    Route::get('/ileri/{tarih}', [ProgramController::class, 'index'])->name('program.tarih.ileri');
    Route::get('/geri/{tarih}', [ProgramController::class, 'index'])->name('program.tarih.geri');
    Route::post('/update/{id}', [ProgramController::class, 'update'])->name('programlar.guncelle');
    Route::delete('/items/{id}', [ProgramController::class, 'destroy'])->name('items.destroy');

    Route::get('/export-xlsx/{tarih}', [ProgramController::class, 'export'])->name('excel.export');
    Route::get('/export-pdf/{tarih}', [ProgramController::class, 'generatePDF'])->name('pdf.export');

    Route::get('/eski-programlar', [ProgramController::class, ''])->name('');
    Route::get('/events', [ProgramController::class, 'getEvents'])->name('programlari.goster');
    Route::post('/update-drag', [ProgramController::class, 'updateDrag'])->name('programlar.surukle.guncelle');
});