<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attacker_match_stats', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('player_match_stat_id')->constrained('player_match_stats')->onDelete('cascade');

            $table->unsignedTinyInteger('hit_woodwork')->default(0);
            $table->unsignedTinyInteger('big_chances_missed')->default(0);
            $table->unsignedTinyInteger('big_chances_created')->default(0);

            $table->unsignedTinyInteger('touches_in_box')->default(0);
            $table->unsignedTinyInteger('progressive_receptions')->default(0);

            $table->unsignedTinyInteger('successful_dribbles')->default(0);
            $table->unsignedTinyInteger('aerial_duels_won')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attacker_match_stats');
    }
};
