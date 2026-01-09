<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalAidCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'legal_issue_type',
        'has_insurance',
        'income_range',
        'employment_status',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}

