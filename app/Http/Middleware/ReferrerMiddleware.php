<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReferrerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Rotalar ve izin verilen referer'lar
        $refererRoutes = [
            'bildirim.musteri.turu' => route('updatePage'), // Sadece updatePage'den
            'bildirim.gonderim.sekli' => route('bildirim.musteri.turu.form'), // Sadece muster.turu.form'dan
            'bildirim.onizleme' => route('bildirim.gonderim.sekli.form'), // Sadece gonderim.sekli.form'dan
            'bildirim.yazi.icerigi' => route('bildirim.onizleme.form'), // Sadece onizleme.form'dan
            'bildirim.onay' => route('bildirim.yazi.icerigi.form') // Sadece yazi.icerigi.form'dan
        ];

        // Mevcut route adı
        $currentRouteName = $request->route()->getName();

        // Eğer mevcut route bir kontrol gerektiriyorsa
        if (isset($refererRoutes[$currentRouteName])) {
            // Gelen istekte referer başlığı kontrol edilir
            $referer = $request->headers->get('referer');

            // İzin verilen referer ile karşılaştırma yapılır
            $allowedReferer = $refererRoutes[$currentRouteName];
            
            // Eğer referer yoksa veya izin verilen kaynaktan değilse ana sayfaya yönlendir
            if (!$referer || strpos($referer, $allowedReferer) === false) {
                return redirect()->route('home')->with('error', 'Bu sayfaya sadece belirli bir sayfadan geçiş yapılabilir.');
            }
        }

        return $next($request);
    }
}