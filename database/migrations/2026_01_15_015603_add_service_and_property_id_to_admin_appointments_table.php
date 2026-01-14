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
        Schema::table('admin_appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_appointments', 'service')) {
                $table->string('service')->nullable()->after('case_details');
            }
            if (!Schema::hasColumn('admin_appointments', 'property_id')) {
                $table->unsignedBigInteger('property_id')->nullable()->after('service');
                $table->foreign('property_id')->references('id')->on('real_estates')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_appointments', function (Blueprint $table) {
            if (Schema::hasColumn('admin_appointments', 'property_id')) {
                $table->dropForeign(['property_id']);
                $table->dropColumn('property_id');
            }
            if (Schema::hasColumn('admin_appointments', 'service')) {
                $table->dropColumn('service');
            }
        });
    }
};
