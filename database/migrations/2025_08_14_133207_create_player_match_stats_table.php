<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('player_match_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players');
            $table->foreignId('football_match_id')->constrained('football_matches');
            $table->foreignId('team_id')->constrained('clubs');
            $table->string('played_position', 5);
            // Add foreign key explicitly
            $table->foreign('played_position')->references('id')->on('positions')->onUpdate('cascade')->onDelete('restrict');

            // Playing time
            $table->unsignedSmallInteger('minutes_played')->default(0);
            $table->boolean('starts')->default(false);
            $table->unsignedSmallInteger('substitute_on_min')->nullable();
            $table->unsignedSmallInteger('substitute_off_min')->nullable();

            // Rating
            $table->decimal('rating', 3, 1)->nullable();

            // Goals and assists
            $table->unsignedTinyInteger('goals')->default(0);
            $table->unsignedTinyInteger('assists')->default(0);

            // Crossing
            $table->unsignedSmallInteger('crosses_attempted')->default(0);
            $table->unsignedSmallInteger('crosses_completed')->default(0);
            $table->decimal('cross_accuracy', 5, 2)->default(0.00);
            // Shooting
            $table->unsignedTinyInteger('shots_total')->default(0);
            $table->unsignedTinyInteger('shots_on_target')->default(0);
            $table->decimal('shot_accuracy', 5, 2)->default(0.00);

            // Passing
            $table->unsignedSmallInteger('passes_attempted')->default(0);
            $table->unsignedSmallInteger('passes_completed')->default(0);
            $table->decimal('pass_accuracy', 5, 2)->default(0.00);

            // Dribbling
            $table->unsignedTinyInteger('dribbles_attempted')->default(0);
            $table->unsignedTinyInteger('dribbles_completed')->default(0);
            $table->decimal('dribble_success_rate', 5, 2)->default(0.00);

            // Defending
            $table->unsignedTinyInteger('tackles_attempted')->default(0);
            $table->unsignedTinyInteger('tackles_won')->default(0);
            $table->decimal('tackle_success_rate', 5, 2)->default(0.00);
            $table->unsignedTinyInteger('interceptions')->default(0);
            $table->unsignedTinyInteger('clearances')->default(0);

            // Discipline
            $table->unsignedTinyInteger('fouls_committed')->default(0);
            $table->unsignedTinyInteger('fouls_suffered')->default(0);
            $table->unsignedTinyInteger('yellow_cards')->default(0);
            $table->unsignedTinyInteger('red_cards')->default(0);
            $table->unsignedTinyInteger('offsides')->default(0);

            // Physical
            $table->decimal('distance_covered_m', 7, 2)->default(0.00);
            $table->decimal('distance_sprinted_m', 7, 2)->default(0.00);

            // Possession
            $table->unsignedTinyInteger('possession_won')->default(0);
            $table->unsignedTinyInteger('possession_lost')->default(0);

            // Heatmap
            $table->jsonb('heatmap')->nullable();


            $table->timestamps();
            // Composite unique index
            $table->unique(['player_id', 'football_match_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('player_match_stats');
    }
};
