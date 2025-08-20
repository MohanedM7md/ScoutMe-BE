<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('match_team_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('football_match_id')->constrained('football_matches');
            $table->foreignId('club_id')->constrained('clubs');
            $table->foreignId('season_id')->constrained('seasons');
            $table->boolean('is_home')->default(false);
            // Match result
            $table->unsignedTinyInteger('goals')->default(0);
            $table->unsignedTinyInteger('goals_conceded')->default(0);
            $table->tinyInteger('result')->nullable()->comment('1=win, 0=draw, -1=loss');

            // Goals breakdown
            $table->unsignedTinyInteger('penalty_goals')->default(0);
            $table->unsignedTinyInteger('penalty_attempts')->default(0);
            $table->unsignedTinyInteger('free_kick_goals')->default(0);
            $table->unsignedTinyInteger('free_kick_attempts')->default(0);
            $table->unsignedTinyInteger('goals_inside_box')->default(0);
            $table->unsignedTinyInteger('shots_inside_box')->default(0);
            $table->unsignedTinyInteger('goals_outside_box')->default(0);
            $table->unsignedTinyInteger('shots_outside_box')->default(0);
            $table->unsignedTinyInteger('left_foot_goals')->default(0);
            $table->unsignedTinyInteger('right_foot_goals')->default(0);
            $table->unsignedTinyInteger('headed_goals')->default(0);

            // Attack stats
            $table->unsignedTinyInteger('big_chances')->default(0);
            $table->unsignedTinyInteger('big_chances_missed')->default(0);
            $table->unsignedTinyInteger('shots')->default(0);
            $table->unsignedTinyInteger('shots_on_target')->default(0);
            $table->unsignedTinyInteger('shots_off_target')->default(0);
            $table->unsignedTinyInteger('blocked_shots')->default(0);
            $table->unsignedTinyInteger('successful_dribbles')->default(0);
            $table->unsignedTinyInteger('hit_woodwork')->default(0);
            $table->unsignedTinyInteger('counter_attacks')->default(0);
            $table->unsignedTinyInteger('big_chances_created')->default(0);
            $table->decimal('expected_goals', 5, 2)->default(0.00);

            // Passing
            $table->decimal('possession', 5, 2)->default(0.00);
            $table->unsignedSmallInteger('passes_attempted')->default(0);
            $table->unsignedSmallInteger('passes_completed')->default(0);
            $table->unsignedSmallInteger('own_half_passes_completed')->default(0);
            $table->unsignedSmallInteger('own_half_passes_attempted')->default(0);
            $table->unsignedSmallInteger('opposition_half_passes_completed')->default(0);
            $table->unsignedSmallInteger('opposition_half_passes_attempted')->default(0);
            $table->unsignedSmallInteger('long_balls_completed')->default(0);
            $table->unsignedSmallInteger('long_balls_attempted')->default(0);
            $table->unsignedSmallInteger('crosses_completed')->default(0);
            $table->unsignedSmallInteger('crosses_attempted')->default(0);
            $table->unsignedSmallInteger('through_balls_completed')->default(0);
            $table->unsignedSmallInteger('progressive_passes')->default(0);

            // Defending
            $table->unsignedTinyInteger('tackles')->default(0);
            $table->unsignedTinyInteger('tackles_won')->default(0);
            $table->unsignedTinyInteger('interceptions')->default(0);
            $table->unsignedTinyInteger('clearances')->default(0);
            $table->unsignedTinyInteger('saves')->default(0);
            $table->unsignedTinyInteger('balls_recovered')->default(0);
            $table->unsignedTinyInteger('errors_leading_to_shot')->default(0);
            $table->unsignedTinyInteger('errors_leading_to_goal')->default(0);
            $table->unsignedTinyInteger('penalties_committed')->default(0);
            $table->unsignedTinyInteger('penalty_goals_conceded')->default(0);
            $table->unsignedTinyInteger('clearances_off_line')->default(0);
            $table->unsignedTinyInteger('last_man_tackles')->default(0);
            $table->boolean('clean_sheet')->default(false);

            // Duels
            $table->unsignedSmallInteger('duels_total')->default(0);
            $table->unsignedSmallInteger('duels_won')->default(0);
            $table->unsignedSmallInteger('ground_duels_total')->default(0);
            $table->unsignedSmallInteger('ground_duels_won')->default(0);
            $table->unsignedSmallInteger('aerial_duels_won')->default(0);
            $table->unsignedSmallInteger('aerial_duels_total')->default(0);

            // Other
            $table->unsignedSmallInteger('possession_lost')->default(0);
            $table->unsignedTinyInteger('throw_ins')->default(0);
            $table->unsignedTinyInteger('goal_kicks')->default(0);
            $table->unsignedTinyInteger('offsides')->default(0);
            $table->unsignedTinyInteger('fouls_committed')->default(0);
            $table->unsignedTinyInteger('fouls_suffered')->default(0);
            $table->unsignedTinyInteger('yellow_cards')->default(0);
            $table->unsignedTinyInteger('red_cards')->default(0);
            $table->unsignedTinyInteger('corners')->default(0);
            $table->unsignedTinyInteger('free_kicks')->default(0);

            $table->timestamps();

            // Composite unique index
            $table->unique(['football_match_id', 'club_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('match_team_stats');
    }
};
