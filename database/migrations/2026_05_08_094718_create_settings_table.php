<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 255)->default('BizStateFiling');
            $table->string('logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->string('admin_email', 255)->nullable();
            $table->string('contact_email', 255)->nullable();
            $table->string('contact_phone', 50)->nullable();
            $table->string('contact_address', 500)->nullable();
            $table->string('facebook_url', 500)->nullable();
            $table->string('instagram_url', 500)->nullable();
            $table->string('twitter_url', 500)->nullable();
            $table->string('pinterest_url', 500)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->string('youtube_url', 500)->nullable();
            $table->text('header_scripts')->nullable();
            $table->text('footer_scripts')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
