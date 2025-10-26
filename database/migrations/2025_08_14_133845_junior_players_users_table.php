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
            $table->string('scout_email', 100)->default("");
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('display_name', 100)->nullable();
            $table->char('nationality_id', 2);
            $table->string("primary_position", 5);
            $table->date('birth_date')->nullable();

            // Physical Attributes
            $table->integer('height_cm')->nullable();
            $table->integer('weight_kg')->nullable();

            $table->enum('preferred_foot', ['left', 'right', 'both'])->nullable();
            $table->text('player_image')->nullable();
            $table->text('video_url')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreign('nationality_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('primary_position')->references('id')->on('positions')->onDelete('cascade');
            $table->boolean('is_profile_complete')->default(false);
            $table->boolean('is_scout')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
