<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAddon extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_addons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'is_default',
        'isPaid',
        'description',
        'author',
        'options',
        'icon',
        'license',
        'url',
        'version',
        'last_update',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_default' => 'boolean',
        'isPaid' => 'boolean',
        'status' => 'boolean',
        'author' => 'array',
        'options' => 'array',
        'last_update' => 'date',
    ];
}
