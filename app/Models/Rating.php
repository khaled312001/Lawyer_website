<?php

namespace App\Models;

use App\Models\User;
use Modules\Lawyer\app\Models\Lawyer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model {
    use HasFactory;

    protected $fillable = [
        'lawyer_id',
        'user_id',
        'rating',
        'comment',
        'is_admin_created',
        'created_by_admin_id',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_admin_created' => 'boolean',
        'status' => 'boolean',
    ];

    protected $hidden = [
        'created_by_admin_id',
        'updated_at',
    ];

    /**
     * Get the lawyer that owns the rating.
     */
    public function lawyer(): BelongsTo {
        return $this->belongsTo(Lawyer::class);
    }

    /**
     * Get the user (client) that created the rating.
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who created the rating.
     */
    public function admin(): BelongsTo {
        return $this->belongsTo(\App\Models\Admin::class, 'created_by_admin_id');
    }

    /**
     * Scope a query to only include active ratings.
     */
    public function scopeActive($query) {
        return $query->where('status', true);
    }

    /**
     * Scope a query to only include client ratings.
     */
    public function scopeClientRatings($query) {
        return $query->where('is_admin_created', false);
    }

    /**
     * Scope a query to only include admin ratings.
     */
    public function scopeAdminRatings($query) {
        return $query->where('is_admin_created', true);
    }
}

