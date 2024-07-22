<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProgramMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tarih;
    protected $filePath;

    /**
     * Create a new message instance.
     */
    public function __construct($tarih, $filePath)
    {
        $this->tarih = $tarih;
        $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Taşköprü ' . $this->tarih . ' Programı',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.program',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('emails.program')
                    ->subject('Program PDF')
                    ->to('varelci.i@gmail.com') // Alıcı e-posta adresi
                    ->cc('ibrahim.varelci@haciogullari.com.tr') // CC e-posta adresleri
                    ->attach($this->filePath, [
                        'as' => 'Taskopru-Program-' . $this->tarih . '.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
