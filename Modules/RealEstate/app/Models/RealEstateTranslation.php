<?php

namespace Modules\RealEstate\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RealEstateTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'real_estate_id',
        'lang_code',
        'title',
        'description',
        'seo_title',
        'seo_description',
    ];

    public function realEstate(): ?BelongsTo
    {
        return $this->belongsTo(RealEstate::class, 'real_estate_id');
    }
}