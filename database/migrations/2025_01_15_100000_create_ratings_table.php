<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Modules\Lawyer\app\Models\Lawyer;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lawyer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('rating')->comment('Rating from 1 to 5');
            $table->text('comment')->nullable();
            $table->boolean('is_admin_created')->default(false)->comment('If true, rating was created by admin');
            $table->unsignedBigInteger('created_by_admin_id')->nullable()->comment('Admin ID who created this rating');
            $table->boolean('status')->default(true)->comment('Active/Inactive rating');
            $table->timestamps();
            
            // Indexes
            $table->index('lawyer_id');
            $table->index('user_id');
            $table->index('rating');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ratings');
    }
};

