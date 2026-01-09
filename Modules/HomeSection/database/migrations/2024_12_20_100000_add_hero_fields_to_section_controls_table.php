<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('section_controls', function (Blueprint $table) {
            $table->string('hero_badge_text')->nullable()->after('blog_status');
            $table->boolean('hero_status')->default(true)->after('hero_badge_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('section_controls', function (Blueprint $table) {
            $table->dropColumn(['hero_badge_text', 'hero_status']);
        });
    }
};

