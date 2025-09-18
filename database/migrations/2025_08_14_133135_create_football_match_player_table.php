<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('football_match_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('football_matches')->onDelete('cascade');
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('clubs')->onDelete('cascade');

            // Position of player in this match (can be different from their main position)
            $table->string('played_position', 5);
            $table->foreign('played_position')->references('id')->on('positions')->onUpdate('cascade')->onDelete('restrict');

            $table->timestamps();
            $table->unique(['match_id', 'player_id','team_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('football_match_player');
    }
};
