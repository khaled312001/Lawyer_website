<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RealEstate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
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
        'slug',
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
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        if ($this->images && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }

        return asset('client/img/property-placeholder.jpg');
    }

    public function getGalleryImagesAttribute()
    {
        if (!$this->images) {
            return [asset('client/img/property-placeholder.jpg')];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
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
    }

    // Relationships (if needed in future)
    public function inquiries()
    {
        return $this->hasMany(RealEstateInquiry::class);
    }
}
