<?php

namespace Modules\RealEstate\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RealEstate extends Model
{
    use HasFactory;

    protected $table = 'real_estates';

    protected $fillable = [
        'slug',
        'property_type',
        'listing_type',
        'city',
        'district',
        'neighborhood',
        'address',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'area',
        'floor',
        'total_floors',
        'year_built',
        'price',
        'currency',
        'price_per_sqm',
        'features',
        'amenities',
        'images',
        'featured_image',
        'status',
        'featured',
        'views',
        'contact_name',
        'contact_phone',
        'contact_email',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'area' => 'decimal:2',
        'price' => 'decimal:2',
        'price_per_sqm' => 'decimal:2',
        'features' => 'array',
        'amenities' => 'array',
        'images' => 'array',
        'seo_keywords' => 'array',
        'featured' => 'boolean',
        'year_built' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'floor' => 'integer',
        'total_floors' => 'integer',
        'views' => 'integer',
    ];

    protected $appends = [
        'formatted_price',
        'formatted_area',
        'main_image_url',
        'gallery_images',
        'location_string',
        'property_type_label',
        'listing_type_label',
        'title',
        'description',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeForSale($query)
    {
        return $query->where('listing_type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('listing_type', 'rent');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('property_type', $type);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        $currency = $this->currency === 'USD' ? '$' : ($this->currency === 'EUR' ? '€' : $this->currency);
        return $currency . number_format($this->price, 0);
    }

    public function getFormattedAreaAttribute()
    {
        return number_format($this->area, 0) . ' m²';
    }

    public function getMainImageUrlAttribute()
    {
        $baseUrl = 'https://lawyer.khaledahmed.net';

        if ($this->featured_image) {
            return $baseUrl . '/storage/' . $this->featured_image;
        }

        if ($this->images && count($this->images) > 0) {
            return $baseUrl . '/storage/' . $this->images[0];
        }

        return $baseUrl . '/client/img/property-placeholder.jpg';
    }

    public function getGalleryImagesAttribute()
    {
        $baseUrl = 'https://lawyer.khaledahmed.net';

        if (!$this->images) {
            return [$baseUrl . '/client/img/property-placeholder.jpg'];
        }

        return array_map(function ($image) use ($baseUrl) {
            return $baseUrl . '/storage/' . $image;
        }, $this->images);
    }

    public function getLocationStringAttribute()
    {
        $parts = array_filter([$this->neighborhood, $this->district, $this->city]);
        return implode(', ', $parts);
    }

    public function getPropertyTypeLabelAttribute()
    {
        return match($this->property_type) {
            'apartment' => __('Apartment'),
            'villa' => __('Villa'),
            'office' => __('Office'),
            'land' => __('Land'),
            'shop' => __('Shop'),
            'warehouse' => __('Warehouse'),
            default => __('Property')
        };
    }

    public function getListingTypeLabelAttribute()
    {
        return match($this->listing_type) {
            'sale' => __('For Sale'),
            'rent' => __('For Rent'),
            default => __('Available')
        };
    }

    public function getTitleAttribute(): ?string
    {
        return $this->translation?->title ?? 'Untitled Property';
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->translation?->description ?? '';
    }

    public function translation(): ?HasOne
    {
        return $this->hasOne(RealEstateTranslation::class)->where('lang_code', getSessionLanguage());
    }

    public function getTranslation($code): ?RealEstateTranslation
    {
        return $this->hasOne(RealEstateTranslation::class)->where('lang_code', $code)->first();
    }

    public function translations(): ?HasMany
    {
        return $this->hasMany(RealEstateTranslation::class, 'real_estate_id');
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($realEstate) {
            if (!$realEstate->slug) {
                $realEstate->slug = Str::slug($realEstate->title);
            }
        });

        static::updating(function ($realEstate) {
            if ($realEstate->isDirty('title') && !$realEstate->isDirty('slug')) {
                $realEstate->slug = Str::slug($realEstate->title);
            }
        });

        static::deleting(function ($realEstate) {
            try {
                if ($realEstate->images) {
                    foreach ($realEstate->images as $image) {
                        if ($image && !str($image)->contains('property-placeholder') && File::exists(public_path('storage/' . $image))) {
                            unlink(public_path('storage/' . $image));
                        }
                    }
                }
                if ($realEstate->featured_image && !str($realEstate->featured_image)->contains('property-placeholder') && File::exists(public_path('storage/' . $realEstate->featured_image))) {
                    unlink(public_path('storage/' . $realEstate->featured_image));
                }
                if ($realEstate->translations) {
                    $realEstate->translations()->delete();
                }
            } catch (\Exception $e) {
                info($e);
            }
        });
    }

    // Relationships
    public function inquiries()
    {
        return $this->hasMany(\App\Models\RealEstateInquiry::class);
    }
}