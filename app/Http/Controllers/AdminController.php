<?php

namespace App\Http\Controllers;

use App\Models\PermissionRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{ 
    public function approvePermission($id)
    {
        $permissionRequest = PermissionRequest::find($id);
        if ($permissionRequest) {
            $permissionRequest->status = 'approved';
            $permissionRequest->expires_at = now()->addDays(3);
            $permissionRequest->save();
    
            // Kullanıcıya bilgi verilebilir
    
            return redirect()->back()->with('success', 'Talep onaylandı.');
        }
    
        return redirect()->back()->with('error', 'Talep bulunamadı.');
    }
}
