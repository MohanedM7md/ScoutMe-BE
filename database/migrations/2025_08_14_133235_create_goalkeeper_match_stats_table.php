<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('goalkeeper_match_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_match_stat_id')->constrained('player_match_stats')->onDelete('cascade');

            $table->unsignedTinyInteger('saves_total')->default(0);
            $table->unsignedTinyInteger('saves_inside_box')->default(0);
            $table->unsignedTinyInteger('saves_outside_box')->default(0);

            $table->unsignedTinyInteger('penalties_faced')->default(0);
            $table->unsignedTinyInteger('penalties_saved')->default(0);

            $table->unsignedTinyInteger('punches')->default(0);
            $table->unsignedTinyInteger('high_claims')->default(0);

            $table->unsignedTinyInteger('goals_conceded')->default(0);
            $table->boolean('clean_sheet')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goalkeeper_match_stats');
    }
};
