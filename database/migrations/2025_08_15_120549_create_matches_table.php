<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();

            // Team relationships
            $table->foreignId('home_team_id')->constrained('clubs');
            $table->foreignId('away_team_id')->constrained('clubs');

            // League relationship (if applicable)
            $table->foreignId('league_id')->nullable()->constrained();

            // Match details
            $table->dateTime('match_date');
            $table->string('venue')->nullable();
            $table->string('referee')->nullable();

            // Match status and scores
            $table->enum('status', [
                'scheduled',
                'in_progress',
                'completed',
                'postponed',
                'cancelled'
            ])->default('scheduled');

            $table->unsignedTinyInteger('home_team_score')->nullable();
            $table->unsignedTinyInteger('away_team_score')->nullable();

            // Match metadata
            $table->unsignedInteger('attendance')->nullable();
            $table->string('round')->nullable(); // Group stage, Quarter-final, etc.
            $table->boolean('is_verified')->default(false);

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index('match_date');
            $table->index('league_id');
            $table->index(['home_team_id', 'away_team_id']);
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
