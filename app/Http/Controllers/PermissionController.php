<?php

namespace App\Http\Controllers;

use App\Models\PermissionRequest;
use App\Notifications\PermissionRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PermissionController extends Controller
{
    
    public function showInfo()
    {
        $title = 'Fiyat Güncelleme Modülü';
        return view('musteri.fiyat.bilgilendirme', compact( 'title'));
    }

    public function permissionPending()
    {
        $title = 'Fiyat Güncelleme Modülü';
        return view('musteri.fiyat.permission_pending', compact( 'title'));
    }

    public function confirmRead(Request $request)
    {
        $request->validate([
            'read_confirm' => 'required',
            'subject' => 'required|string|max:255',
        ]);

        // Yöneticilere bildirim gönder
        $managers = User::where('role', 'admin')->get();

        $permissionRequest = PermissionRequest::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject, // İzin konusunu alıyoruz
            'expires_at' => now()->addDays(3), // 3 günlük süre
            'status' => 'bekliyor',
        ]);

        Notification::send($managers, new PermissionRequestNotification($permissionRequest));

        return redirect()->route('permission.pending');
    }
}
