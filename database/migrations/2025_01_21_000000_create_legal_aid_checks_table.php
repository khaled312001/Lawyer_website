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
        Schema::create('legal_aid_checks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('legal_issue_type');
            $table->enum('has_insurance', ['yes', 'no', 'unsure']);
            $table->enum('income_range', ['low', 'average', 'above_average', 'high']);
            $table->enum('employment_status', ['employed', 'unemployed', 'self_employed']);
            $table->enum('status', ['pending', 'reviewed', 'contacted'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_aid_checks');
    }
};

