<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Menandai notifikasi spesifik sebagai 'sudah dibaca'
     * Dipanggil saat user klik tombol checklist di dashboard
     */
    public function markAsRead($id)
    {
        // Cari notifikasi milik user yang sedang login berdasarkan ID
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->first();

        // Jika ketemu, tandai sudah dibaca (isi kolom read_at di database)
        if ($notification) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * (Opsional) Menandai SEMUA notifikasi sebagai 'sudah dibaca'
     */
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}