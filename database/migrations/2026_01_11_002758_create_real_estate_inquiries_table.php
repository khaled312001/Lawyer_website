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
        Schema::create('real_estate_inquiries', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('real_estate_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Personal Information
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('message')->nullable();

            // Contact Preferences
            $table->enum('preferred_contact_method', ['phone', 'email', 'both'])->default('phone');
            $table->json('contact_times')->nullable(); // preferred contact times

            // Inquiry Status
            $table->enum('status', ['new', 'contacted', 'qualified', 'not_interested', 'closed'])->default('new');
            $table->text('notes')->nullable();

            // Tracking
            $table->json('metadata')->nullable(); // additional data
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('qualified_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['real_estate_id', 'status']);
            $table->index(['user_id', 'status']);
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_inquiries');
    }
};
