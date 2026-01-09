<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'company',
        'partnership_type',
        'message',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
