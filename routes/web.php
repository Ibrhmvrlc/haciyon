<?php

use App\Http\Controllers\MusteriController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // TUM KULLANICILAR

Route::middleware(['auth'])->prefix('/program')->group(function(){ // PAZARLAMACILAR, YONETICELER
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
    Route::get('/email-pdf/{tarih}', [ProgramController::class, 'sendMailWithPDF'])->name('pdf.email');
});

Route::middleware(['auth'])->prefix('/musteri')->group(function(){ // PAZARLAMACILAR, YONETICELER
    Route::get('/tum-liste', [MusteriController::class, 'index'])->name('tum.musteri.listesi');
    Route::get('/aktif-liste', [MusteriController::class, 'aktifIndex'])->name('aktif.musteri.listesi');
    Route::get('/profil/{id}', [MusteriController::class, 'profile'])->name('musteri.profil');
    Route::get('/aktif-musteri-profil/{id}', [MusteriController::class, 'aktifProfile'])->name('aktif.musteri.profil');
    Route::post('/not-ekle/{id}', [MusteriController::class, 'addNote'])->name('not.ekle');
    Route::put('/not-tamamlandi/{id}', [MusteriController::class, 'update'])->name('not.tamamalandi');
    Route::post('/santiye-fiyat-guncelle/{id}', [MusteriController::class, 'santiyeFiyatGuncelle'])->name('santiye.fiyat.guncelle');
    Route::post('/yeni-santiye-ekle/{id}', [MusteriController::class, 'yeniSantiyeEkle'])->name('santiye.ekle');
    Route::post('/yeni-yetkili-ekle/{id}', [MusteriController::class, 'yetkiliEkle'])->name('yetkili.ekle');
    Route::get('/yetkili-sil/{id}', [MusteriController::class, 'yetkiliSil'])->name('yetkili.sil');
    Route::post('/fatura-bilgileri-guncelle/{id}', [MusteriController::class, 'faturaBilgileriGuncelle'])->name('fatura.bilgileri.guncelle');
    Route::post('/iletisim-bilgileri-guncelle/{id}', [MusteriController::class, 'iletisimBilgileriGuncelle'])->name('iletisim.bilgileri.guncelle');
    Route::get('/fiyat-listesi', [MusteriController::class, 'fiyatListesiIndex'])->name('fiyat.listesi');
});