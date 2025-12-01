<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('junior_players', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // link to user

    $table->string('first_name', 100);
    $table->string('last_name', 100);
    $table->string('display_name', 100)->nullable();
    $table->char('nationality_id', 2);
    $table->date('birth_date')->nullable();

    $table->string('gender', 20)->nullable();
    $table->string('height_cm', 10)->nullable();
    $table->string('weight_kg', 10)->nullable();

    $table->json('positions')->nullable();
    $table->string('primary_position', 50)->nullable();
    $table->json('video_urls')->nullable();
    $table->json('fav_feet')->nullable();

    $table->text('player_image')->nullable();
    $table->text('description')->nullable();
    $table->string('current_club')->nullable();
    $table->text('previous_clubs_info')->nullable();

    $table->boolean('is_profile_complete')->default(false);
    $table->boolean('is_scout')->default(false);

    $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('junior_players');
    }
};
