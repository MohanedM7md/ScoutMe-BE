<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('football_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->constrained('clubs');
            $table->foreignId('away_team_id')->constrained('clubs');
            $table->foreignId('competition_id')->constrained('competitions');
            $table->timestamp('match_date');
            $table->string('status', 20); // 'scheduled', 'in_play', 'finished', 'postponed', 'canceled'
            $table->string('referee', 100)->nullable();
            $table->timestamps();
            // Indexes
            $table->index('match_date');
            $table->index(['home_team_id', 'away_team_id', 'match_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('football_matches');
    }
};
