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
        Schema::create('user_socials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('social_media', ['facebook', 'twitter', 'tiktok', 'whatsapp', 'telegram', 'discord', 'linkedin', 'youtube']);
            $table->string('link');
            $table->enum('status', ['pending', 'approved', 'declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_socials');
    }
};
