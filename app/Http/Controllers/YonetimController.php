<?php

namespace App\Http\Controllers;

use App\Models\PermissionRequest;
use Illuminate\Http\Request;

class YonetimController extends Controller
{
    public function fiyatGuncellemeTalepleri(){
        $title = 'Fiyat Güncelleme Talepleri';

        $veriler = PermissionRequest::paginate(30); // Sayfa başına kayıt sayısı
        return view('yonetim.talepler.fiyat_guncelleme', compact('title', 'veriler'));
    }

    public function fgtOnay($id){
        $fgtOnay = PermissionRequest::findOrFail($id);
        $fgtOnay->status = 'onaylandi';
        $fgtOnay->expires_at = $fgtOnay->created_at->addDays(3);
        $fgtOnay->save();

        // Talep olusturan kullaniciya bildirim atilacak !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        return redirect()->back();
    }

    public function fgtRed($id){
        $fgtOnay = PermissionRequest::findOrFail($id);
        $fgtOnay->status = 'reddedildi';
        $fgtOnay->expires_at = $fgtOnay->created_at->addDays(3);
        $fgtOnay->save();

        // Talep olusturan kullaniciya bildirim atilacak  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        return redirect()->back();
    }
}
