<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Lawyer\app\Models\Lawyer;
use App\Models\Admin;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'last_message_id',
        'last_message_at',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the sender (polymorphic)
     */
    public function sender(): MorphTo
    {
        return $this->morphTo('sender');
    }

    /**
     * Get the receiver (polymorphic)
     */
    public function receiver(): MorphTo
    {
        return $this->morphTo('receiver');
    }

    /**
     * Get the user (client) in this conversation - helper method
     */
    public function getUserAttribute()
    {
        if ($this->sender_type == User::class) {
            return $this->sender;
        } elseif ($this->receiver_type == User::class) {
            return $this->receiver;
        }
        return null;
    }

    /**
     * Get the lawyer in this conversation - helper method
     */
    public function getLawyerAttribute()
    {
        if ($this->sender_type == Lawyer::class) {
            return $this->sender;
        } elseif ($this->receiver_type == Lawyer::class) {
            return $this->receiver;
        }
        return null;
    }

    /**
     * Get the admin in this conversation - helper method
     */
    public function getAdminAttribute()
    {
        if ($this->sender_type == Admin::class) {
            return $this->sender;
        } elseif ($this->receiver_type == Admin::class) {
            return $this->receiver;
        }
        return null;
    }

    /**
     * Get all messages in this conversation
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the latest message in this conversation
     */
    public function latestMessage()
    {
        if ($this->last_message_id) {
            return $this->hasOne(Message::class, 'id', 'last_message_id');
        }
        return $this->hasOne(Message::class)->latestOfMany();
    }
}

