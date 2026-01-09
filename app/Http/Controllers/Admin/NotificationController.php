<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $notifications = $admin->notifications()->paginate(20);
        
        return view('admin.notifications.index', compact('notifications'));
    }

    public function fetch()
    {
        $admin = Auth::guard('admin')->user();
        $notifications = $admin->unreadNotifications()->latest()->take(10)->get();
        $unreadCount = $admin->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    public function markAsRead($id)
    {
        $admin = Auth::guard('admin')->user();
        $notification = $admin->notifications()->where('id', $id)->first();
        
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $admin = Auth::guard('admin')->user();
        $admin->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function getUnreadMessagesCount()
    {
        $admin = Auth::guard('admin')->user();
        
        // Count unread messages in conversations where admin is receiver
        // Messages from users/clients to admin that are not read
        $unreadCount = Message::whereHas('conversation', function($query) use ($admin) {
            $query->where(function($q) use ($admin) {
                // Conversations where admin is receiver
                $q->where('receiver_type', 'App\Models\Admin')
                  ->where('receiver_id', $admin->id);
            })->orWhere(function($q) use ($admin) {
                // Or conversations where admin is sender (to see all conversations)
                $q->where('sender_type', 'App\Models\Admin')
                  ->where('sender_id', $admin->id);
            });
        })
        ->where('is_read', false)
        ->where(function($query) {
            // Messages not sent by admin
            $query->where('sender_type', 'App\Models\User')
                  ->orWhere('sender_type', 'Modules\Lawyer\app\Models\Lawyer');
        })
        ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }
}

