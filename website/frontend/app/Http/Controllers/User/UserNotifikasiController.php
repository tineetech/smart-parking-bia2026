<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->latest()
            ->limit(10)
            ->get();

        $unreadCount = Notifikasi::where('user_id', Auth::id())
            ->belumDibaca()
            ->count();

        return response()->json([
            'notifikasi' => $notifikasi,
            'unread_count' => $unreadCount,
        ]);
    }

    public function markAsRead(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        $notifikasi->update(['sudah_dibaca' => true]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->belumDibaca()
            ->update(['sudah_dibaca' => true]);

        return response()->json(['success' => true]);
    }
}
