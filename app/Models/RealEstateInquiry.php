<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealEstateInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'real_estate_id',
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'preferred_contact_method',
        'contact_times',
        'status',
        'notes',
        'metadata',
        'contacted_at',
        'qualified_at',
    ];

    protected $casts = [
        'contact_times' => 'array',
        'metadata' => 'array',
        'contacted_at' => 'datetime',
        'qualified_at' => 'datetime',
    ];

    // Relationships
    public function realEstate(): BelongsTo
    {
        return $this->belongsTo(RealEstate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    public function scopeQualified($query)
    {
        return $query->where('status', 'qualified');
    }

    // Methods
    public function markAsContacted()
    {
        $this->update([
            'status' => 'contacted',
            'contacted_at' => now(),
        ]);
    }

    public function markAsQualified()
    {
        $this->update([
            'status' => 'qualified',
            'qualified_at' => now(),
        ]);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'new' => '<span class="badge bg-primary">جديد</span>',
            'contacted' => '<span class="badge bg-info">تم التواصل</span>',
            'qualified' => '<span class="badge bg-success">مؤهل</span>',
            'not_interested' => '<span class="badge bg-warning">غير مهتم</span>',
            'closed' => '<span class="badge bg-secondary">مغلق</span>',
            default => '<span class="badge bg-light">غير محدد</span>'
        };
    }
}
