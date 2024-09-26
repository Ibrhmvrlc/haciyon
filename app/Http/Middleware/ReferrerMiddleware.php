<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        // Kaynak sayfa URL'si (tam URL ya da sadece path)
        $allowedReferer = route('bildirim.musteri.turu.form'); // Kaynak sayfanın rotasını belirtin.

        // Gelen istekte referer başlığı kontrol edilir
        $referer = $request->headers->get('referer');

        // Eğer referer başlığı kaynak sayfadan değilse geri gönder
        if (!$referer || strpos($referer, $allowedReferer) === false) {
            // Kullanıcıyı mevcut sayfasına geri yönlendir
            return redirect()->back()->with('error', 'Bu sayfaya sadece belirli bir sayfadan geçiş yapılabilir.');
        }

        return $next($request);
    }
}