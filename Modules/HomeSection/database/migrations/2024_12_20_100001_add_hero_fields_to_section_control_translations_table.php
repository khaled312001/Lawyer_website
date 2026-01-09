<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\HomeSection\app\Models\SectionControl;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('section_control_translations', function (Blueprint $table) {
            $table->string('hero_title')->nullable()->after('blog_description');
            $table->text('hero_description')->nullable()->after('hero_title');
            $table->string('hero_feature_1_title')->nullable()->after('hero_description');
            $table->text('hero_feature_1_description')->nullable()->after('hero_feature_1_title');
            $table->string('hero_feature_2_title')->nullable()->after('hero_feature_1_description');
            $table->text('hero_feature_2_description')->nullable()->after('hero_feature_2_title');
            $table->string('hero_feature_3_title')->nullable()->after('hero_feature_2_description');
            $table->text('hero_feature_3_description')->nullable()->after('hero_feature_3_title');
            $table->string('hero_search_title')->nullable()->after('hero_feature_3_description');
            $table->text('hero_search_subtitle')->nullable()->after('hero_search_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('section_control_translations', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title',
                'hero_description',
                'hero_feature_1_title',
                'hero_feature_1_description',
                'hero_feature_2_title',
                'hero_feature_2_description',
                'hero_feature_3_title',
                'hero_feature_3_description',
                'hero_search_title',
                'hero_search_subtitle'
            ]);
        });
    }
};

