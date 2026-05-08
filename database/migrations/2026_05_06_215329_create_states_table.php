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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->default(1)->constrained()->onDelete('cascade');
            $table->string('state_name', 100);
            $table->string('state_slug', 100)->unique();
            $table->string('filing_name', 150)->nullable();
            $table->decimal('filing_fee', 10, 2)->default(0);
            $table->decimal('late_fee', 10, 2)->default(0);
            $table->enum('deadline_type', ['fixed', 'anniversary', 'varies'])->default('fixed');
            $table->tinyInteger('deadline_month')->nullable();
            $table->tinyInteger('deadline_day')->nullable();
            $table->string('renewal_cycle', 50)->nullable();
            $table->boolean('report_required')->default(1);
            $table->string('compliance_agency', 255)->nullable();
            $table->text('portal_url')->nullable();
            $table->text('affiliate_url')->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->text('seo_description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};