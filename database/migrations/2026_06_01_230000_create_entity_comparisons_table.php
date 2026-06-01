<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entity_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_type_id')->constrained('entity_types')->onDelete('cascade');
            $table->foreignId('compared_entity_type_id')->constrained('entity_types')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('cascade');
            $table->string('category', 100)->nullable()->default('overview')->comment('e.g. overview, taxation, liability, formation, compliance');
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->text('notes')->nullable()->comment('Admin notes about this comparison');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['entity_type_id', 'compared_entity_type_id', 'state_id', 'country_id', 'category'], 'unique_comparison');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entity_comparisons');
    }
};
