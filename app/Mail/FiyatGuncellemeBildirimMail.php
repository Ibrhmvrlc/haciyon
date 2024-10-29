<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class FiyatGuncellemeBildirimMail extends Mailable
{
    use Queueable, SerializesModels;

    public $musteri;
    public $fiyatlar;
    public $urunler;

    public function __construct($musteri, $fiyatlar, $urunler)
    {
        $this->musteri = $musteri;
        $this->fiyatlar = $fiyatlar;
        $this->urunler = $urunler;
    }

    public function build()
    {
        $mail = $this->subject("Fiyat Güncelleme Bildirimi - {$this->musteri->isim}")
                    ->view('emails.fiyat_bildirim');

        // Her şantiye için ayrı PDF dosyası oluşturup ek olarak ekle
        foreach ($this->fiyatlar as $santiyeId => $fiyatListesi) {
            // Şantiyeye özel PDF oluştur
            $pdf = Pdf::loadView('musteri.fiyat.fiyat_taslagi', [
                'musteri' => $this->musteri,
                'fiyatlar' => $fiyatListesi, // Şantiyeye özel fiyat listesi
                'urunler' => $this->urunler
            ]);

            // Dosya adı olarak şantiye ID’sini kullanarak eklere ekleyin
            $mail->attachData($pdf->output(), "fiyat_guncelleme_{$this->musteri->isim}_santiye_{$santiyeId}.pdf", [
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }

}