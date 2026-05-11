<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compliance_deadlines', function (Blueprint $table) {
            $table->id();
            $table->string('deadline_name', 255);
            $table->text('description')->nullable();
            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->string('entity_type', 100)->nullable(); // llc, corp, all
            $table->enum('deadline_type', ['static', 'dynamic'])->default('static');
            // For static dates
            $table->tinyInteger('fixed_month')->nullable();
            $table->tinyInteger('fixed_day')->nullable();
            // For dynamic rules
            $table->string('rule_label', 255)->nullable(); // e.g. "90 days after formation"
            $table->enum('rule_type', ['days_after_formation', 'days_after_fy_end', 'anniversary', 'fixed'])->default('fixed');
            $table->integer('rule_days')->nullable();
            $table->string('category', 100)->default('annual_report'); // annual_report, franchise_tax, statement_info, publication, ra_renewal, ein
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('state_id');
            $table->index('entity_type');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compliance_deadlines');
    }
};
