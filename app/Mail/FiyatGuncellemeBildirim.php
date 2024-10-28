<?php
// app/Mail/FiyatGuncellemeBildirim.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class FiyatGuncellemeBildirim extends Mailable
{
    use Queueable, SerializesModels;

    public $musteri;
    public $fiyatBilgileri;

    public function __construct($musteri, $fiyatBilgileri)
    {
        $this->musteri = $musteri;
        $this->fiyatBilgileri = $fiyatBilgileri;
    }

    public function build()
    {
        // PDF oluştur
        $pdf = Pdf::loadView('emails.fiyat_bildirim', [
            'musteri' => $this->musteri,
            'fiyatBilgileri' => $this->fiyatBilgileri
        ]);

        return $this->subject("Fiyat Güncelleme Bildirimi")
                    ->view('emails.fiyat_guncelleme_bildirim')
                    ->attachData($pdf->output(), "fiyat_guncelleme_{$this->musteri->isim}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}