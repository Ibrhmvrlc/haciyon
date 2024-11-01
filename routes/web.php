<?php

use App\Http\Controllers\MusteriController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\YonetimController;
use App\Http\Controllers\ZamAPIController;
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
    Route::prefix('/fiyat-listesi')->group(function(){ 
        Route::get('/bilgilendirme', [PermissionController::class, 'showInfo'])->middleware(\App\Http\Middleware\IsPending::class)->name('showInfo');
        Route::post('/bilgilendirme', [PermissionController::class, 'confirmRead'])->name('confirmRead');
        Route::get('/onay-bekleniyor', [PermissionController::class, 'permissionPending'])->middleware(\App\Http\Middleware\IsTherePermission::class)->name('permission.pending');

        Route::get('/tabulator-data', [MusteriController::class, 'getData'])->middleware(\App\Http\Middleware\CheckPermission::class)->name('updatePage');
        Route::post('/tabulator-data/{id}', [MusteriController::class, 'updateData'])->name('tabulator.updateData');
    });
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
    Route::get('/aktif-musteri/get', [MusteriController::class, 'getClients'])->name('aktif_musteri.get');
    Route::post('/aktif-musteri/store', [MusteriController::class, 'store'])->name('aktif_musteri.store');
    Route::put('/aktif-musteri/update/{id}', [MusteriController::class, 'update'])->name('aktif_musteri.update');
    Route::delete('/aktif-musteri/destroy/{id}', [MusteriController::class, 'destroy'])->name('aktif_musteri.destroy');

    Route::get('/zam-bildirimi/musteri-turu', [MusteriController::class, 'musteriTuru'])->name('bildirim.musteri.turu');
    Route::post('/zam-bildirimi/musteri-turu', [MusteriController::class, 'ilkAdimForm'])->name('bildirim.musteri.turu.form');

    Route::get('/zam-bildirimi/genel-tercihler', [MusteriController::class, 'gonderimSekli'])->middleware(\App\Http\Middleware\ReferrerMiddleware::class)->name('bildirim.gonderim.sekli');
    Route::post('/zam-bildirimi/genel-tercihler', [MusteriController::class, 'ikinciAdimForm'])->name('bildirim.gonderim.sekli.form');

    Route::get('/zam-bildirimi/gonderim-tercihleri', [MusteriController::class, 'onizleme'])->middleware(\App\Http\Middleware\ReferrerMiddleware::class)->name('bildirim.onizleme');
    Route::post('/zam-bildirimi/gonderim-tercihleri', [MusteriController::class, 'ucuncuAdim'])->name('bildirim.onizleme.form');

    Route::get('/zam-bildirimi/yazi-icerigi', [MusteriController::class, 'yaziIcerigi'])->middleware(\App\Http\Middleware\ReferrerMiddleware::class)->name('bildirim.yazi.icerigi');
    Route::post('/zam-bildirimi/yazi-icerigi', [MusteriController::class, 'dorduncuAdim'])->name('bildirim.yazi.icerigi.form');

    Route::get('/zam-bildirimi/onay', [MusteriController::class, 'onay'])->middleware(\App\Http\Middleware\ReferrerMiddleware::class)->name('bildirim.onay');
    Route::get('/zam-bildirimi/fiyat-yazisi/{musteri_id}/{santiye_id}', [MusteriController::class, 'showPdf'])->middleware(\App\Http\Middleware\ReferrerMiddleware::class)->name('bildirim.fiyat_yazisi');
    Route::post('/zam-bildirimi/onay', [MusteriController::class, 'topluFiyatGuncellemeBildirimiGonder'])->name('bildirim.onay.form');
    Route::get('/zam-bildirimi/onay/iptal/{id}', [MusteriController::class, 'yaziyiIptalEt'])->name('bildirim.onay.iptal.santiye');
    Route::get('/zam-bildirimi/onay/aktif/{id}', [MusteriController::class, 'yaziyiAktifEt'])->name('bildirim.onay.aktif.santiye');


    Route::get('/filtrele', [MusteriController::class, 'filter'])->name('musteri.filter');

});


Route::middleware(['auth'])->prefix('/yonetim')->group(function(){ // YONETICELER
    Route::get('/fiyat-guncelleme-talepleri', [YonetimController::class, 'fiyatGuncellemeTalepleri'])->name('fiyat.guncelleme.talepleri');
    Route::get('/fiyat-guncelleme-talebi-onay/{id}', [YonetimController::class, 'fgtOnay'])->name('fgt.onay');
    Route::get('/fiyat-guncelleme-talebi-red/{id}', [YonetimController::class, 'fgtRed'])->name('fgt.red');
});
