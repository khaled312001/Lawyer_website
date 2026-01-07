<?php

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('admin_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Admin::class)->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('case_type')->nullable();
            $table->text('case_details')->nullable();
            $table->text('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->text('client_address')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_country')->nullable();
            $table->text('problem_description')->nullable();
            $table->text('additional_info')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            
            $table->foreign('department_id')->references('id')->on('departments')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('admin_appointments');
    }
};

