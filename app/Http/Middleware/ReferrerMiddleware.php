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
            'bildirim.musteri.turu' => [route('updatePage')], // Sadece updatePage'den
            'bildirim.gonderim.sekli' => [route('bildirim.musteri.turu.form')], // Sadece muster.turu.form'dan
            'bildirim.onizleme' => [route('bildirim.gonderim.sekli.form')], // Sadece gonderim.sekli.form'dan
            'bildirim.yazi.icerigi' => [route('bildirim.onizleme.form')], // Sadece onizleme.form'dan
            'bildirim.onay' => [
                route('bildirim.yazi.icerigi.form'),  // yazi.icerigi.form'dan
                'back' // return back() durumu için
            ]
        ];

        // Mevcut route adı
        $currentRouteName = $request->route()->getName();

        // Eğer mevcut route bir kontrol gerektiriyorsa
        if (isset($refererRoutes[$currentRouteName])) {
            // Gelen istekte referer başlığı kontrol edilir
            $referer = $request->headers->get('referer');

            // İzin verilen referer'lar dizisi
            $allowedReferers = $refererRoutes[$currentRouteName];
            
            // Eğer referer yoksa veya izin verilen kaynaklardan gelmiyorsa ana sayfaya yönlendir
            if (!$referer || !$this->isRefererAllowed($referer, $allowedReferers, $request)) {
                return redirect()->route('home')->with('error', 'Bu sayfaya sadece belirli bir sayfadan geçiş yapılabilir.');
            }
        }

        return $next($request);
    }

    /**
     * Referer'in izin verilen kaynaklardan gelip gelmediğini kontrol eder.
     *
     * @param  string  $referer
     * @param  array  $allowedReferers
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isRefererAllowed($referer, $allowedReferers, $request)
    {
        foreach ($allowedReferers as $allowedReferer) {
            // Eğer allowedReferer 'back' ise, önceki sayfaya geri dönme kontrolü
            if ($allowedReferer === 'back') {
                // Referer, önceki sayfa yönlendirmesiyse geçerli kabul et
                if (url()->previous() === $referer) {
                    return true;
                }
            }

            // Diğer izin verilen rotaları kontrol et
            if (strpos($referer, $allowedReferer) !== false) {
                return true;
            }
        }

        return false;
    }
}