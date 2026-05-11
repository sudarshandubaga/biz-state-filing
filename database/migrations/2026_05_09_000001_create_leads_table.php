<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            // Step 1 - Entity Type
            $table->string('entity_type'); // llc, s-corporation, c-corporation, partnership, sole-proprietorship, professional-entity, foreign-qualification
            // Step 2 - State
            $table->foreignId('state_id')->constrained('states');
            // Step 3 - Universal Questions
            $table->string('business_name');
            $table->boolean('name_available')->nullable();
            $table->boolean('needs_registered_agent')->default(false);
            $table->string('business_address')->nullable();
            $table->boolean('needs_ein')->default(false);
            $table->boolean('needs_annual_report_assistance')->default(false);
            // Step 4 - Entity Specific Data (JSON)
            $table->json('entity_specific_data')->nullable();
            // Step 5 - Review (summary snapshot)
            $table->json('summary_data')->nullable();
            // Step 6 - Affiliate Matching
            $table->json('matched_affiliates')->nullable();
            // Step 7 - Lead Routing
            $table->string('routing_method')->nullable(); // single, multi, weighted
            $table->unsignedBigInteger('routed_to_affiliate_id')->nullable();
            // Step 8 - Delivery Status
            $table->string('status')->default('in_progress'); // in_progress, matched, routed, sent, completed
            $table->boolean('sent_to_partner')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->json('delivery_log')->nullable();
            // Session tracking
            $table->string('session_id')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('session_id');
            $table->index('entity_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
