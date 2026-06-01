<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entity_types', function (Blueprint $table) {
            $table->string('label', 120)->nullable()->after('short_description');
            $table->string('headline', 255)->nullable()->after('label');
            $table->text('sub_headline')->nullable()->after('headline');
            $table->text('intro_content')->nullable()->after('sub_headline');
            $table->text('not_recommended_for')->nullable()->after('intro_content');
            $table->text('tax_deep_dive')->nullable()->after('not_recommended_for');
            $table->text('tax_treatment_summary')->nullable()->after('tax_deep_dive');
            $table->string('liability_protection', 255)->nullable()->after('tax_treatment_summary');
            $table->string('taxation_type', 255)->nullable()->after('liability_protection');
            $table->string('ownership_structure', 255)->nullable()->after('taxation_type');
            $table->string('best_for_tagline', 255)->nullable()->after('ownership_structure');
            $table->string('formation_cost_range', 100)->nullable()->after('best_for_tagline');
            $table->string('compliance_level', 100)->nullable()->after('formation_cost_range');
            $table->string('complexity_level', 100)->nullable()->after('compliance_level');
            $table->json('features_data')->nullable()->after('complexity_level');
            $table->json('steps_data')->nullable()->after('features_data');
            $table->json('faqs_data')->nullable()->after('steps_data');
            $table->json('comparison_data')->nullable()->after('faqs_data');
        });
    }

    public function down(): void
    {
        Schema::table('entity_types', function (Blueprint $table) {
            $table->dropColumn([
                'label',
                'headline',
                'sub_headline',
                'intro_content',
                'not_recommended_for',
                'tax_deep_dive',
                'tax_treatment_summary',
                'liability_protection',
                'taxation_type',
                'ownership_structure',
                'best_for_tagline',
                'formation_cost_range',
                'compliance_level',
                'complexity_level',
                'features_data',
                'steps_data',
                'faqs_data',
                'comparison_data',
            ]);
        });
    }
};
