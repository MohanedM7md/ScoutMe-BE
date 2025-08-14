<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('player_aggregated_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players');
            $table->string('stat_type', 10); // 'season' or 'career'
            $table->unsignedSmallInteger('season_year')->nullable(); // For seasonal stats

            // General stats
            $table->unsignedSmallInteger('total_matches')->default(0);
            $table->unsignedMediumInteger('total_minutes')->default(0);

            // Offensive
            $table->unsignedSmallInteger('goals')->default(0);
            $table->unsignedSmallInteger('assists')->default(0);
            $table->unsignedSmallInteger('shots_total')->default(0);
            $table->unsignedSmallInteger('shots_on_target')->default(0);

            // Passing
            $table->unsignedMediumInteger('passes_attempted')->default(0);
            $table->unsignedMediumInteger('passes_completed')->default(0);

            // Defensive
            $table->unsignedSmallInteger('tackles_attempted')->default(0);
            $table->unsignedSmallInteger('tackles_won')->default(0);
            $table->unsignedSmallInteger('interceptions')->default(0);
            $table->unsignedSmallInteger('clearances')->default(0);

            // Discipline
            $table->unsignedSmallInteger('fouls_committed')->default(0);
            $table->unsignedSmallInteger('fouls_suffered')->default(0);
            $table->unsignedSmallInteger('yellow_cards')->default(0);
            $table->unsignedSmallInteger('red_cards')->default(0);

            $table->timestamps();

            // Composite unique index
            $table->unique(['player_id', 'stat_type', 'season_year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('player_aggregated_stats');
    }
};
