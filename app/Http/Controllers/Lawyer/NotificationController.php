<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $lawyer = Auth::guard('lawyer')->user();
        $notifications = $lawyer->notifications()->paginate(20);
        
        return view('lawyer.notifications.index', compact('notifications'));
    }

    public function fetch()
    {
        try {
            $lawyer = Auth::guard('lawyer')->user();
            
            if (!$lawyer) {
                return response()->json([
                    'notifications' => [],
                    'unread_count' => 0
                ], 401);
            }

            $notifications = $lawyer->unreadNotifications()->latest()->take(10)->get();
            $unreadCount = $lawyer->unreadNotifications()->count();

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
        $lawyer = Auth::guard('lawyer')->user();
        $notification = $lawyer->notifications()->where('id', $id)->first();
        
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $lawyer = Auth::guard('lawyer')->user();
        $lawyer->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}

