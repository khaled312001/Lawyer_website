<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Admin;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display all conversations (Admin can see all)
     */
    public function index()
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $conversations = Conversation::with([
            'sender', 
            'receiver',
            'messages'
        ])
        ->where(function($query) {
            // Conversations between User and Lawyer
            $query->where(function($q) {
                $q->where('sender_type', 'App\Models\User')
                  ->where('receiver_type', 'Modules\Lawyer\app\Models\Lawyer');
            })->orWhere(function($q) {
                $q->where('sender_type', 'Modules\Lawyer\app\Models\Lawyer')
                  ->where('receiver_type', 'App\Models\User');
            });
        })
        ->orderBy('updated_at', 'desc')
        ->paginate(20);
        
        // Eager load department for lawyers after pagination
        foreach ($conversations as $conversation) {
            if ($conversation->lawyer && !$conversation->lawyer->relationLoaded('department')) {
                $conversation->lawyer->load('department.translation');
            }
        }
        
        return view('admin.messages.index', compact('conversations'));
    }

    /**
     * Show specific conversation
     */
    public function show($conversationId)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $conversation = Conversation::with([
            'sender', 
            'receiver', 
            'messages.sender'
        ])
        ->findOrFail($conversationId);
        
        // Eager load department for lawyer if exists
        if ($conversation->lawyer && !$conversation->lawyer->relationLoaded('department')) {
            $conversation->lawyer->load('department.translation');
        }
        
        return view('admin.messages.show', compact('conversation'));
    }

    /**
     * Admin can send message to conversation
     */
    public function sendMessage(Request $request, $conversationId)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);
        
        $conversation = Conversation::findOrFail($conversationId);
        
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('message-attachments', 'public');
        }
        
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_type' => Admin::class,
            'sender_id' => auth()->guard('admin')->id(),
            'message' => $request->message,
            'attachment' => $attachmentPath,
        ]);
        
        $conversation->update(['last_message_at' => now()]);
        
        return back()->with('success', __('Message sent successfully'));
    }

    /**
     * Close/Archive conversation
     */
    public function toggleStatus($conversationId)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $conversation = Conversation::findOrFail($conversationId);
        $newStatus = $conversation->status == 'active' ? 'closed' : 'active';
        $conversation->update(['status' => $newStatus]);
        
        return back()->with('success', __('Conversation status updated successfully'));
    }
}
