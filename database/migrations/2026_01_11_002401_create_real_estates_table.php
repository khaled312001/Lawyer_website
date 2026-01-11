<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('title', 255);
            $table->text('description');
            $table->string('property_type')->index(); // apartment, villa, office, land, etc.
            $table->string('listing_type')->index(); // sale, rent

            // Location Information
            $table->string('city', 100);
            $table->string('district', 100)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Property Details
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2); // in square meters
            $table->integer('floor')->nullable();
            $table->integer('total_floors')->nullable();
            $table->year('year_built')->nullable();

            // Financial Information
            $table->decimal('price', 15, 2);
            $table->string('currency', 3)->default('USD');
            $table->decimal('price_per_sqm', 10, 2)->nullable();

            // Features and Amenities
            $table->json('features')->nullable(); // parking, garden, pool, etc.
            $table->json('amenities')->nullable(); // furnished, balcony, etc.

            // Media
            $table->json('images')->nullable(); // array of image paths
            $table->string('featured_image', 255)->nullable();

            // Status and Management
            $table->enum('status', ['active', 'inactive', 'sold', 'rented'])->default('active');
            $table->boolean('featured')->default(false);
            $table->integer('views')->default(0);

            // Contact Information
            $table->string('contact_name', 255);
            $table->string('contact_phone', 20);
            $table->string('contact_email', 255)->nullable();

            // SEO and Display
            $table->string('slug', 255)->unique();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['status', 'featured']);
            $table->index(['property_type', 'listing_type']);
            $table->index(['city', 'district']);
            $table->index('price');
            $table->index('area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
