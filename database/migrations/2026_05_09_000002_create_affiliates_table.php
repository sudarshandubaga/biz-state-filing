<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            // Matching criteria
            $table->json('supported_states')->nullable(); // array of state IDs
            $table->json('supported_entity_types')->nullable(); // array of entity types
            $table->json('services_offered')->nullable(); // array of service slugs
            $table->boolean('is_available')->default(true);
            $table->integer('commission_priority')->default(0); // higher = priority
            $table->integer('current_load')->default(0); // current lead count for load balancing
            $table->integer('max_load')->default(100);
            // API/webhook
            $table->string('webhook_url')->nullable();
            $table->string('api_key')->nullable();
            // Status
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('is_available');
            $table->index('commission_priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
