<?php

namespace App\Http\Controllers\Lawyer;

use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\ClientChatMessage;
use App\Http\Controllers\Controller;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\Lawyer\app\Models\Lawyer;
use App\Notifications\NewMessageNotification;

class LawyerMessageController extends Controller {
    public function index() {
        $lawyer = lawyerAuth();
        
        // Get all conversations between this lawyer and admins only
        $conversations = Conversation::where(function($query) use ($lawyer) {
            // Lawyer is receiver and Admin is sender
            $query->where(function($q) use ($lawyer) {
                $q->where('receiver_type', Lawyer::class)
                  ->where('receiver_id', $lawyer->id)
                  ->where('sender_type', Admin::class);
            })
            // Or lawyer is sender and Admin is receiver
            ->orWhere(function($q) use ($lawyer) {
                $q->where('sender_type', Lawyer::class)
                  ->where('sender_id', $lawyer->id)
                  ->where('receiver_type', Admin::class);
            });
        })
        ->with(['sender', 'receiver', 'messages' => function($query) {
            $query->latest()->limit(1);
        }])
        ->orderBy('last_message_at', 'desc')
        ->get();
        
        // Get unique admins from conversations
        $admins = collect();
        foreach ($conversations as $conversation) {
            $admin = $conversation->admin;
            if ($admin && !$admins->contains('id', $admin->id)) {
                $admins->push($admin);
            }
        }
        
        // If no conversations exist, get all admins to show in the list
        if ($admins->isEmpty()) {
            $admins = Admin::all();
        }
        
        return view('lawyer.message.index', compact('admins', 'conversations'));
    }

    public function messageBox($id) {
        $admin = Admin::findOrFail($id);
        $lawyer = lawyerAuth();
        $my_id = $lawyer->id;
        
        // Find or create conversation between lawyer and admin
        $conversation = Conversation::where(function($query) use ($my_id, $admin) {
            $query->where(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Lawyer::class)
                  ->where('sender_id', $my_id)
                  ->where('receiver_type', Admin::class)
                  ->where('receiver_id', $admin->id);
            })->orWhere(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Admin::class)
                  ->where('sender_id', $admin->id)
                  ->where('receiver_type', Lawyer::class)
                  ->where('receiver_id', $my_id);
            });
        })->first();
        
        if (!$conversation) {
            // Create new conversation
            $conversation = Conversation::create([
                'sender_type' => Lawyer::class,
                'sender_id' => $my_id,
                'receiver_type' => Admin::class,
                'receiver_id' => $admin->id,
                'status' => 'active',
                'last_message_at' => now(),
            ]);
        }
        
        // Mark messages as read
        $conversation->messages()
            ->where('sender_type', Admin::class)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        $messages = $conversation->messages()->with('sender')->orderBy('created_at', 'asc')->get();
        
        // Get all admins for sidebar
        $conversations = Conversation::where(function($query) use ($lawyer) {
            $query->where(function($q) use ($lawyer) {
                $q->where('receiver_type', Lawyer::class)
                  ->where('receiver_id', $lawyer->id)
                  ->where('sender_type', Admin::class);
            })->orWhere(function($q) use ($lawyer) {
                $q->where('sender_type', Lawyer::class)
                  ->where('sender_id', $lawyer->id)
                  ->where('receiver_type', Admin::class);
            });
        })->with(['sender', 'receiver'])->get();
        
        $admins = collect();
        foreach ($conversations as $conv) {
            $adm = $conv->admin;
            if ($adm && !$admins->contains('id', $adm->id)) {
                $admins->push($adm);
            }
        }
        
        if ($admins->isEmpty()) {
            $admins = Admin::all();
        }
        
        return view('lawyer.message.single-message', compact('admins', 'messages', 'admin', 'conversation'));
    }

    public function getMessage($admin_id) {
        $lawyer = lawyerAuth();
        $my_id = $lawyer->id;
        $admin = Admin::findOrFail($admin_id);
        
        // Find conversation
        $conversation = Conversation::where(function($query) use ($my_id, $admin) {
            $query->where(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Lawyer::class)
                  ->where('sender_id', $my_id)
                  ->where('receiver_type', Admin::class)
                  ->where('receiver_id', $admin->id);
            })->orWhere(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Admin::class)
                  ->where('sender_id', $admin->id)
                  ->where('receiver_type', Lawyer::class)
                  ->where('receiver_id', $my_id);
            });
        })->first();
        
        if (!$conversation) {
            $messages = collect();
        } else {
            // Mark messages as read
            $conversation->messages()
                ->where('sender_type', Admin::class)
                ->where('is_read', false)
                ->update(['is_read' => true, 'read_at' => now()]);
            
            $messages = $conversation->messages()->with('sender')->orderBy('created_at', 'asc')->get();
        }
        
        return view('lawyer.message.message-box', compact('messages', 'conversation'));
    }
    
    public function seenMessage($admin_id) {
        $lawyer = lawyerAuth();
        $my_id = $lawyer->id;
        $admin = Admin::findOrFail($admin_id);
        
        $conversation = Conversation::where(function($query) use ($my_id, $admin) {
            $query->where(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Lawyer::class)
                  ->where('sender_id', $my_id)
                  ->where('receiver_type', Admin::class)
                  ->where('receiver_id', $admin->id);
            })->orWhere(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Admin::class)
                  ->where('sender_id', $admin->id)
                  ->where('receiver_type', Lawyer::class)
                  ->where('receiver_id', $my_id);
            });
        })->first();
        
        if ($conversation) {
            $conversation->messages()
                ->where('sender_type', Admin::class)
                ->where('is_read', false)
                ->update(['is_read' => true, 'read_at' => now()]);
        }
        
        return response()->json(['status' => 'success'], 200);
    }

    public function sendMessage(Request $request) {
        $this->validate($request, [
            'receiver_id' => 'required',
            'message'     => 'required',
        ]);
        $lawyer = lawyerAuth();
        $my_id = $lawyer->id;
        $admin = Admin::findOrFail($request->receiver_id);

        // Find or create conversation
        $conversation = Conversation::where(function($query) use ($my_id, $admin) {
            $query->where(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Lawyer::class)
                  ->where('sender_id', $my_id)
                  ->where('receiver_type', Admin::class)
                  ->where('receiver_id', $admin->id);
            })->orWhere(function($q) use ($my_id, $admin) {
                $q->where('sender_type', Admin::class)
                  ->where('sender_id', $admin->id)
                  ->where('receiver_type', Lawyer::class)
                  ->where('receiver_id', $my_id);
            });
        })->first();
        
        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_type' => Lawyer::class,
                'sender_id' => $my_id,
                'receiver_type' => Admin::class,
                'receiver_id' => $admin->id,
                'status' => 'active',
                'last_message_at' => now(),
            ]);
        }

        // Save message to the database
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => Lawyer::class,
            'sender_id' => $my_id,
            'message' => strip_tags($request->message),
        ]);
        
        $conversation->update(['last_message_at' => now()]);

        // Broadcast the event
        $data = (object) [
            'message' => $message->message,
            'sender_id' => $my_id,
            'receiver_id' => $admin->id,
            'created_at' => formattedDateTime($message->created_at),
            'un_seen' => $conversation->messages()
                ->where('sender_type', Lawyer::class)
                ->where('is_read', false)
                ->count(),
        ];
        $pusher_status = cache('setting')?->pusher_status ?? Setting::where('key', 'pusher_status')->value('value');
        if($pusher_status == 'active'){
            event(new ClientChatMessage($data));
        }

        // Send notification to admin
        try {
            if ($admin && $lawyer) {
                $admin->notify(new NewMessageNotification($message->message, $lawyer->name, 'lawyer', $conversation->id));
            }
        } catch (\Exception $e) {
            info('Admin notification error: ' . $e->getMessage());
        }

        return response()->json(['admin_id' => $request->receiver_id]);
    }
}
