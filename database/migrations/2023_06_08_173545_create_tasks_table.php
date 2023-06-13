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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('content');
            $table->float('amount');
            $table->enum('social_media', ['facebook', 'twitter', 'tiktok', 'whatsapp', 'telegram', 'discord', 'linkedin', 'youtube'])->nullable();
            $table->string('user_limit')->nullable();
            $table->string('image')->nullable();
            $table->date('day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
