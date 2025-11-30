<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     * Data yang diterima: ['title', 'message', 'url']
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Tentukan saluran pengiriman (Database agar muncul di dashboard)
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Format data yang disimpan ke database
     */
    public function toArray($notifiable)
    {
        return [
            'title'   => $this->data['title'],
            'message' => $this->data['message'],
            'url'     => $this->data['url'] ?? '#',
        ];
    }
}