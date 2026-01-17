<?php

namespace Modules\RealEstate\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\RealEstate\app\Models\RealEstateTranslation;

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
        // Check featured_image first
        if ($this->featured_image) {
            $imagePath = $this->featured_image;
            // Check if it's already a full path or relative path
            if (str_starts_with($imagePath, 'http')) {
                return $imagePath;
            }
            // Check storage path
            if (file_exists(storage_path('app/public/' . $imagePath))) {
                return asset('storage/' . $imagePath);
            }
            // Check public path (for backward compatibility)
            if (file_exists(public_path('storage/' . $imagePath))) {
                return asset('storage/' . $imagePath);
            }
        }

        // Check images array
        if ($this->images && count($this->images) > 0) {
            $firstImage = $this->images[0];
            // Check if it's already a full path or relative path
            if (is_string($firstImage) && str_starts_with($firstImage, 'http')) {
                return $firstImage;
            }
            // Check storage path
            if (file_exists(storage_path('app/public/' . $firstImage))) {
                return asset('storage/' . $firstImage);
            }
            // Check public path (for backward compatibility)
            if (file_exists(public_path('storage/' . $firstImage))) {
                return asset('storage/' . $firstImage);
            }
        }

        return asset('client/img/property-placeholder.jpg');
    }

    public function getGalleryImagesAttribute()
    {
        if (!$this->images) {
            return [asset('client/img/property-placeholder.jpg')];
        }

        return array_map(function ($image) {
            // Check if it's already a full URL
            if (is_string($image) && str_starts_with($image, 'http')) {
                return $image;
            }
            // Check storage path
            if (file_exists(storage_path('app/public/' . $image))) {
                return asset('storage/' . $image);
            }
            // Check public path (for backward compatibility)
            if (file_exists(public_path('storage/' . $image))) {
                return asset('storage/' . $image);
            }
            return asset('client/img/property-placeholder.jpg');
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
        // Try to get translation for current language
        $translation = $this->translation;
        
        if ($translation && !empty($translation->title)) {
            return $translation->title;
        }
        
        // Fallback: try to get any available translation
        // Check if translations relationship is loaded
        if ($this->relationLoaded('translations')) {
            $fallbackTranslation = $this->translations
                ->whereNotNull('title')
                ->where('title', '!=', '')
                ->first();
        } else {
            // If not loaded, query it
            $fallbackTranslation = $this->translations()
                ->whereNotNull('title')
                ->where('title', '!=', '')
                ->first();
        }
        
        if ($fallbackTranslation && !empty($fallbackTranslation->title)) {
            return $fallbackTranslation->title;
        }
        
        // Last resort: return null instead of 'Untitled Property'
        return null;
    }

    public function getDescriptionAttribute(): ?string
    {
        // Try to get translation for current language
        $translation = $this->translation;
        
        if ($translation && !empty($translation->description)) {
            return $translation->description;
        }
        
        // Fallback: try to get any available translation
        // Check if translations relationship is loaded
        if ($this->relationLoaded('translations')) {
            $fallbackTranslation = $this->translations
                ->whereNotNull('description')
                ->where('description', '!=', '')
                ->first();
        } else {
            // If not loaded, query it
            $fallbackTranslation = $this->translations()
                ->whereNotNull('description')
                ->where('description', '!=', '')
                ->first();
        }
        
        if ($fallbackTranslation && !empty($fallbackTranslation->description)) {
            return $fallbackTranslation->description;
        }
        
        return '';
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
                // Temporarily disable appends to avoid triggering accessors during deletion
                $originalAppends = $realEstate->getAppends();
                $realEstate->setAppends([]);
                
                // Get raw attribute values to avoid triggering accessors that might cause array to string conversion
                $imagesRaw = $realEstate->getRawOriginal('images');
                $featuredImageRaw = $realEstate->getRawOriginal('featured_image');
                
                // Decode JSON if needed, or use as-is if already an array
                $images = is_string($imagesRaw) ? json_decode($imagesRaw, true) : $imagesRaw;
                
                if ($images && is_array($images)) {
                    foreach ($images as $image) {
                        if ($image && is_string($image) && !str($image)->contains('property-placeholder') && File::exists(public_path('storage/' . $image))) {
                            unlink(public_path('storage/' . $image));
                        }
                    }
                }
                if ($featuredImageRaw && is_string($featuredImageRaw) && !str($featuredImageRaw)->contains('property-placeholder') && File::exists(public_path('storage/' . $featuredImageRaw))) {
                    unlink(public_path('storage/' . $featuredImageRaw));
                }
                
                // Delete translations using the relationship query builder (avoid eager loading)
                RealEstateTranslation::where('real_estate_id', $realEstate->id)->delete();
                
                // Restore appends (though model will be deleted anyway)
                $realEstate->setAppends($originalAppends);
            } catch (\Exception $e) {
                info('Error deleting real estate: ' . $e->getMessage());
            }
        });
    }

    // Relationships
    public function inquiries()
    {
        return $this->hasMany(\App\Models\RealEstateInquiry::class);
    }
}