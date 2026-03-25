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
        Schema::create('lawyer_join_requests', function (Blueprint $table) {
            $table->id();
            $table->string('lawyer_name');
            $table->string('lawyer_email');
            $table->string('country_code', 10);
            $table->string('lawyer_phone');
            $table->string('specialization');
            $table->unsignedTinyInteger('experience_years');
            $table->string('lawyer_location');
            $table->text('lawyer_bio');
            $table->string('cv_path')->nullable();
            $table->string('status', 20)->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyer_join_requests');
    }
};
