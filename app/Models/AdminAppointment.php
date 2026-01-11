<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Lawyer\app\Models\Department;
use Modules\Lawyer\app\Models\Lawyer;

class AdminAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'lawyer_id',
        'department_id',
        'appointment_date',
        'appointment_time',
        'case_type',
        'case_details',
        'country_code',
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'client_city',
        'client_country',
        'problem_description',
        'additional_info',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}

