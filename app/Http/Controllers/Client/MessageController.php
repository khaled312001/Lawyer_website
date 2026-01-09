<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Only show conversations between client and admin
        $conversations = Conversation::where(function($query) use ($user) {
                $query->where(function($q) use ($user) {
                    // Client is sender, Admin is receiver
                    $q->where('sender_id', $user->id)
                      ->where('sender_type', User::class)
                      ->where('receiver_type', Admin::class);
                })->orWhere(function($q) use ($user) {
                    // Admin is sender, Client is receiver
                    $q->where('receiver_id', $user->id)
                      ->where('receiver_type', User::class)
                      ->where('sender_type', Admin::class);
                });
            })
            ->with(['receiver', 'sender', 'latestMessage'])
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('client.messages.index', compact('conversations', 'user'));
    }

    public function show(Conversation $conversation)
    {
        $user = Auth::user();

        // Ensure the user is part of this conversation
        $isSender = $conversation->sender_id == $user->id && $conversation->sender_type == User::class;
        $isReceiver = $conversation->receiver_id == $user->id && $conversation->receiver_type == User::class;
        
        if (!$isSender && !$isReceiver) {
            abort(403);
        }

        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();

        // Mark messages as read (messages from lawyer or admin)
        $conversation->messages()
            ->where('sender_type', '!=', User::class)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('client.messages.show', compact('conversation', 'messages', 'user'));
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        $request->validate([
            'message' => 'nullable|string|max:2000',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        // Ensure at least one field is provided
        if (!$request->filled('message') && !$request->hasFile('attachment')) {
            return response()->json(['error' => __('Please provide a message or attachment')], 422);
        }

        $user = Auth::user();

        $isSender = $conversation->sender_id == $user->id && $conversation->sender_type == User::class;
        $isReceiver = $conversation->receiver_id == $user->id && $conversation->receiver_type == User::class;
        
        if (!$isSender && !$isReceiver) {
            return response()->json(['error' => __('Unauthorized')], 403);
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments/messages', 'public');
        }

        $message = $conversation->messages()->create([
            'sender_id' => $user->id,
            'sender_type' => User::class,
            'message' => $request->message ?? '',
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        $conversation->update(['last_message_at' => now()]);

        // Send notification to admin if receiver is admin
        if ($conversation->receiver_type === Admin::class) {
            try {
                $admin = Admin::find($conversation->receiver_id);
                if ($admin) {
                    $admin->notify(new NewMessageNotification($message->message, $user->name, 'user'));
                }
            } catch (\Exception $e) {
                info('Admin notification error: ' . $e->getMessage());
            }
        }

        return response()->json(['status' => 'success', 'message' => __('Message sent successfully')]);
    }


    public function getMessages(Conversation $conversation)
    {
        $user = Auth::user();

        $isSender = $conversation->sender_id == $user->id && $conversation->sender_type == User::class;
        $isReceiver = $conversation->receiver_id == $user->id && $conversation->receiver_type == User::class;
        
        if (!$isSender && !$isReceiver) {
            return response()->json(['error' => __('Unauthorized')], 403);
        }

        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();

        return response()->json(['messages' => $messages]);
    }

    public function markAsRead(Conversation $conversation)
    {
        $user = Auth::user();

        $isSender = $conversation->sender_id == $user->id && $conversation->sender_type == User::class;
        $isReceiver = $conversation->receiver_id == $user->id && $conversation->receiver_type == User::class;
        
        if (!$isSender && !$isReceiver) {
            return response()->json(['error' => __('Unauthorized')], 403);
        }

        $conversation->messages()
            ->where('sender_type', '!=', User::class)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json(['status' => 'success']);
    }

    /**
     * Start a conversation with admin
     */
    public function startConversationWithAdmin(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', __('Please login first'));
            }

            // Get the first admin (or you can modify this to get a specific admin)
            $admin = Admin::first();
            
            if (!$admin) {
                return redirect()->route('client.messages.index')
                    ->with('error', __('No admin found. Please contact support.'));
            }

            // Check if a conversation already exists
            $conversation = Conversation::where(function($query) use ($user, $admin) {
                    $query->where(function($q) use ($user, $admin) {
                        $q->where('sender_id', $user->id)
                          ->where('sender_type', User::class)
                          ->where('receiver_id', $admin->id)
                          ->where('receiver_type', Admin::class);
                    })->orWhere(function($q) use ($user, $admin) {
                        $q->where('sender_id', $admin->id)
                          ->where('sender_type', Admin::class)
                          ->where('receiver_id', $user->id)
                          ->where('receiver_type', User::class);
                    });
                })
                ->first();

            if (!$conversation) {
                $conversation = Conversation::create([
                    'sender_id' => $user->id,
                    'sender_type' => User::class,
                    'receiver_id' => $admin->id,
                    'receiver_type' => Admin::class,
                    'status' => 'active',
                    'last_message_at' => now(),
                    'problem_type' => $request->problem_type ?? null,
                ]);
            } else {
                // Update problem_type if provided and conversation exists
                if ($request->has('problem_type') && $request->problem_type) {
                    $conversation->update(['problem_type' => $request->problem_type]);
                }
            }

            return redirect()->route('client.messages.show', $conversation->id)
                ->with('success', __('Conversation started successfully'));
        } catch (\Exception $e) {
            \Log::error('Error starting conversation with admin: ' . $e->getMessage());
            return redirect()->route('client.messages.index')
                ->with('error', __('An error occurred. Please try again.'));
        }
    }
}
