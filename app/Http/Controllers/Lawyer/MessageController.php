<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Modules\Lawyer\app\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display all conversations for the lawyer
     */
    public function index()
    {
        $lawyer = Auth::guard('lawyer')->user();
        
        $conversations = Conversation::where('lawyer_id', $lawyer->id)
            ->with(['user', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->get();
        
        return view('lawyer.messages.index', compact('conversations'));
    }

    /**
     * Show conversation with specific client
     */
    public function show($conversationId)
    {
        $lawyer = Auth::guard('lawyer')->user();
        
        $conversation = Conversation::where('id', $conversationId)
            ->where('lawyer_id', $lawyer->id)
            ->with(['user', 'messages.sender'])
            ->firstOrFail();
        
        // Mark all client messages as read
        $conversation->messages()
            ->where('sender_type', 'App\Models\User')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        return view('lawyer.messages.show', compact('conversation'));
    }

    /**
     * Send message
     */
    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);
        
        $lawyer = Auth::guard('lawyer')->user();
        
        $conversation = Conversation::where('id', $conversationId)
            ->where('lawyer_id', $lawyer->id)
            ->firstOrFail();
        
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message-attachments', 'public');
        }
        
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => Lawyer::class,
            'sender_id' => $lawyer->id,
            'message' => $request->message,
            'attachment' => $attachmentPath,
        ]);
        
        $conversation->update(['last_message_at' => now()]);

        // Send notification to all admins when lawyer sends message
        try {
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewMessageNotification($message->message, $lawyer->name, 'lawyer'));
            }
        } catch (\Exception $e) {
            info('Admin notification error: ' . $e->getMessage());
        }
        
        return back()->with('success', __('Message sent successfully'));
    }
}
