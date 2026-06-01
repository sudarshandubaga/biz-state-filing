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
        Schema::table('states', function (Blueprint $table) {
            // Hero Section
            $table->text('hero_heading')->nullable()->after('seo_description');
            $table->text('hero_subheading')->nullable()->after('hero_heading');

            // Metrics / Quick Stats
            $table->string('standard_processing_days', 50)->nullable()->after('hero_subheading');
            $table->string('standard_processing_label', 255)->nullable()->after('standard_processing_days');
            $table->string('expedited_processing_text', 100)->nullable()->after('standard_processing_label');
            $table->string('expedited_processing_label', 255)->nullable()->after('expedited_processing_text');
            $table->decimal('annual_llc_fee', 10, 2)->nullable()->default(0)->after('expedited_processing_label');
            $table->string('annual_llc_fee_label', 255)->nullable()->after('annual_llc_fee');

            // CTA Section
            $table->text('cta_heading')->nullable()->after('annual_llc_fee_label');
            $table->text('cta_subheading')->nullable()->after('cta_heading');

            // Strategic Benefits (JSON for flexibility)
            $table->json('benefits_data')->nullable()->after('cta_subheading');

            // Industry Sectors Table Data (JSON)
            $table->json('industry_sectors_data')->nullable()->after('benefits_data');

            // Execution Steps (JSON)
            $table->json('execution_steps_data')->nullable()->after('industry_sectors_data');

            // FAQs (JSON)
            $table->json('faqs_data')->nullable()->after('execution_steps_data');

            // Ecosystem Panel
            $table->text('ecosystem_heading')->nullable()->after('faqs_data');
            $table->text('ecosystem_content')->nullable()->after('ecosystem_heading');
            $table->string('ecosystem_link_url', 255)->nullable()->after('ecosystem_content');
            $table->string('ecosystem_link_text', 255)->nullable()->after('ecosystem_link_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn([
                'hero_heading',
                'hero_subheading',
                'standard_processing_days',
                'standard_processing_label',
                'expedited_processing_text',
                'expedited_processing_label',
                'annual_llc_fee',
                'annual_llc_fee_label',
                'cta_heading',
                'cta_subheading',
                'benefits_data',
                'industry_sectors_data',
                'execution_steps_data',
                'faqs_data',
                'ecosystem_heading',
                'ecosystem_content',
                'ecosystem_link_url',
                'ecosystem_link_text',
            ]);
        });
    }
};
