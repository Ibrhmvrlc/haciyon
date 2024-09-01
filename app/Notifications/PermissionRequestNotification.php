<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\PermissionRequest;

class PermissionRequestNotification extends Notification
{
    use Queueable;

    protected $permissionRequest;

    // Notification constructor - PermissionRequest instance injected
    public function __construct(PermissionRequest $permissionRequest)
    {
        $this->permissionRequest = $permissionRequest;
    }

    // Notification will be sent via mail
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Email content for the notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Yeni İzin Talebi: ' . $this->permissionRequest->subject)
                    ->greeting('Merhaba Yönetici,')
                    ->line('Bir kullanıcı "' . $this->permissionRequest->subject . '" konusunda güncelleme izni talep etti.')
                    ->action('Talebi Görüntüle', url('/admin/permissions'))
                    ->line('Teşekkürler!');
    }

    // Optionally, add a method to handle database notifications
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->permissionRequest->user_id,
            'subject' => $this->permissionRequest->subject,
            'status' => $this->permissionRequest->status,
        ];
    }
}
