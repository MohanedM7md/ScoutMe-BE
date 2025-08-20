<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('player_match_stats', function (Blueprint $table) {
            // Primary and foreign keys
            $table->id();
            $table->foreignId('player_id')->constrained('players');
            $table->foreignId('football_match_id')->constrained('football_matches');
            $table->string('played_position', 5);
            $table->foreignId('season_id')->constrained('seasons');
            // Add foreign key explicitly
            $table->foreign('played_position')->references('id')->on('positions')->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('is_goalkeeper')->default(false);

            // ========== ATTACKING STATS ==========
            $table->unsignedInteger('goals')->default(0);
            $table->unsignedInteger('assists')->default(0);
            $table->unsignedInteger('shots_total')->default(0);
            $table->unsignedInteger('shots_on_target')->default(0);
            $table->decimal('shot_accuracy', 5, 2)->default(0);
            $table->unsignedInteger('hit_woodwork')->default(0);
            $table->unsignedInteger('big_chances_missed')->default(0);
            $table->unsignedInteger('big_chances_created')->default(0);
            $table->unsignedInteger('touches_in_box')->default(0);
            $table->unsignedInteger('progressive_receptions')->default(0);
            $table->unsignedInteger('dribbles_attempted')->default(0);
            $table->unsignedInteger('dribbles_completed')->default(0);
            $table->decimal('dribble_success_rate', 5, 2)->default(0);
            $table->unsignedInteger('progressive_carries')->default(0);
            $table->unsignedInteger('offsides')->default(0);

            // ========== DEFENDING STATS ==========
            $table->unsignedInteger('tackles')->default(0);
            $table->unsignedInteger('tackles_won')->default(0);
            $table->decimal('tackle_success_rate', 5, 2)->default(0);
            $table->unsignedInteger('interceptions')->default(0);
            $table->unsignedInteger('clearances')->default(0);
            $table->unsignedInteger('blocks')->default(0);
            $table->unsignedInteger('shot_blocks')->default(0);
            $table->unsignedInteger('recoveries')->default(0);
            $table->unsignedSmallInteger('ground_duels')->default(0);
            $table->unsignedSmallInteger('ground_duels_won')->default(0);
            $table->unsignedInteger('aerial_duels')->default(0);
            $table->unsignedInteger('aerial_duels_won')->default(0);
            $table->unsignedInteger('possession')->default(0);
            $table->unsignedInteger('possession_won')->default(0);
            // ========== GENERAL STATS ==========
            $table->unsignedSmallInteger('starts')->default(0);
            $table->unsignedSmallInteger('substitute_on_min')->nullable();
            $table->unsignedSmallInteger('substitute_off_min')->nullable();
            $table->unsignedSmallInteger('minutes_played')->default(0);
            $table->unsignedInteger('passes_attempted')->default(0);
            $table->unsignedInteger('passes_completed')->default(0);
            $table->decimal('pass_accuracy', 5, 2)->default(0);
            $table->unsignedInteger('progressive_passes')->default(0);
            $table->unsignedInteger('fouls_committed')->default(0);
            $table->unsignedInteger('fouls_suffered')->default(0);
            $table->unsignedInteger('yellow_cards')->default(0);
            $table->unsignedInteger('red_cards')->default(0);
            $table->decimal('distance_covered_m', 10, 2)->default(0);
            $table->decimal('distance_sprinted_m', 10, 2)->default(0);
            $table->unsignedSmallInteger('crosses_attempted')->default(0);
            $table->unsignedSmallInteger('crosses_completed')->default(0);
            $table->decimal('cross_accuracy', 5, 2)->default(0.00);
            $table->json('heatmap')->nullable();
            $table->timestamps();

            // Composite unique index
            $table->unique(['player_id', 'football_match_id']);
            // Crossing

        });
    }

    public function down()
    {
        Schema::dropIfExists('player_match_stats');
    }
};
