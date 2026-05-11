<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tax_forms', function (Blueprint $table) {
            $table->id();
            $table->string('form_name', 255);
            $table->string('form_number', 100)->nullable(); // e.g. SS-4, AR-1
            $table->text('description')->nullable();
            $table->string('category', 100)->default('formation'); // formation, compliance, tax
            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->string('entity_type', 100)->nullable(); // llc, corp, etc or 'all'
            $table->string('download_url')->nullable();
            $table->boolean('is_official')->default(true);
            $table->string('official_url')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('category');
            $table->index('entity_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tax_forms');
    }
};
