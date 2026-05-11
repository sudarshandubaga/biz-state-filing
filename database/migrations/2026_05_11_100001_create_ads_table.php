<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('image', 500)->nullable();
            $table->string('ad_type', 50)->default('banner'); // banner, sidebar, inline, popup
            $table->string('target_url', 500)->nullable();
            $table->string('placement', 100)->nullable(); // top_banner, sidebar_top, sidebar_bottom, inline_content, footer, bottom_cta
            $table->string('category', 100)->nullable(); // llc_formation, registered_agent, compliance, tax_forms, business_insurance
            $table->json('states_targeting')->nullable(); // ["NY","TX","CA"]
            $table->json('naics_targeting')->nullable(); // ["722511","236115"]
            $table->string('device_targeting', 50)->default('all'); // all, mobile, desktop
            $table->integer('weight')->default(5); // 1-10 for rotation
            $table->string('utm_source', 255)->nullable();
            $table->string('utm_medium', 255)->nullable();
            $table->string('utm_campaign', 255)->nullable();
            $table->foreignId('affiliate_id')->nullable()->constrained('affiliates')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('max_impressions')->nullable();
            $table->integer('max_clicks')->nullable();
            $table->integer('current_impressions')->default(0);
            $table->integer('current_clicks')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Ad impressions & clicks tracking table
        Schema::create('ad_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ads')->cascadeOnDelete();
            $table->string('type', 10); // impression or click
            $table->string('page_url', 500)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad_tracking');
        Schema::dropIfExists('ads');
    }
};
