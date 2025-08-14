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
            $table->boolean('is_home');

            // Passing
            $table->decimal('passes_attempted', 5, 2)->nullable();
            $table->decimal('passes_completed', 5, 2)->nullable();
            $table->decimal('pass_accuracy', 5, 2)->nullable();

            // Possession
            $table->decimal('possession', 5, 2)->nullable();

            // Shooting
            $table->integer('shots')->nullable();
            $table->integer('shots_on_target')->nullable();
            $table->decimal('expected_goals', 5, 2)->nullable();
            $table->decimal('shot_accuracy', 5, 2)->nullable();

            // Defending
            $table->integer('tackles')->nullable();
            $table->integer('tackles_won')->nullable();
            $table->integer('interceptions')->nullable();
            $table->integer('fouls_committed')->nullable();

            // Other stats
            $table->integer('offsides')->nullable();
            $table->integer('corners')->nullable();
            $table->integer('free_kicks')->nullable();
            $table->integer('penalty_kicks')->nullable();
            $table->integer('yellow_cards')->nullable();
            $table->integer('red_cards')->nullable();
            $table->integer('saves')->nullable();

            // Dribbling
            $table->decimal('dribble_success_rate', 5, 2)->nullable();

            $table->timestamps();

            // Composite unique index
            // $table->unique(['football_match_id', 'club_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('match_team_stats');
    }
};
