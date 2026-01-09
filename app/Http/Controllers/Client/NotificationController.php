<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(20);
        
        return view('client.notifications.index', compact('notifications'));
    }

    public function fetch()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'notifications' => [],
                    'unread_count' => 0
                ], 401);
            }

            $notifications = $user->unreadNotifications()->latest()->take(10)->get();
            $unreadCount = $user->unreadNotifications()->count();

            // Format notifications for JSON response
            $formattedNotifications = $notifications->map(function($notification) {
                try {
                    $data = $notification->data ?? [];
                    // Ensure data is an array
                    if (!is_array($data)) {
                        $data = is_string($data) ? json_decode($data, true) : [];
                    }
                    
                    return [
                        'id' => $notification->id,
                        'type' => $notification->type ?? '',
                        'data' => $data,
                        'read_at' => $notification->read_at ? $notification->read_at->toDateTimeString() : null,
                        'created_at' => $notification->created_at ? $notification->created_at->toDateTimeString() : null,
                    ];
                } catch (\Exception $e) {
                    \Log::error('Notification format error: ' . $e->getMessage() . ' - Notification ID: ' . $notification->id);
                    return [
                        'id' => $notification->id,
                        'type' => 'error',
                        'data' => ['title' => __('Error loading notification'), 'message' => ''],
                        'read_at' => null,
                        'created_at' => $notification->created_at ? $notification->created_at->toDateTimeString() : null,
                    ];
                }
            })->filter(); // Remove any null entries

            return response()->json([
                'notifications' => $formattedNotifications,
                'unread_count' => $unreadCount
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification fetch error: ' . $e->getMessage());
            return response()->json([
                'notifications' => [],
                'unread_count' => 0,
                'error' => 'Failed to load notifications'
            ], 500);
        }
    }

    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();
        
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}

