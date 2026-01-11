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
            $table->unsignedBigInteger('lawyer_id')->nullable()->after('admin_id');
            $table->foreign('lawyer_id')->references('id')->on('lawyers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_appointments', function (Blueprint $table) {
            $table->dropForeign(['lawyer_id']);
            $table->dropColumn('lawyer_id');
        });
    }
};
