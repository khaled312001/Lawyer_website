<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerJoinRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'lawyer_name',
        'lawyer_email',
        'country_code',
        'lawyer_phone',
        'specialization',
        'experience_years',
        'lawyer_location',
        'lawyer_bio',
        'cv_path',
        'status',
        'admin_notes',
    ];
}
