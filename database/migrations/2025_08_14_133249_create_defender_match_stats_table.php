<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('defender_match_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_match_stat_id')->constrained('player_match_stats')->onDelete('cascade');

            $table->unsignedTinyInteger('blocks')->default(0);
            $table->unsignedTinyInteger('shot_blocks')->default(0);
            $table->unsignedTinyInteger('aerial_duels_won')->default(0);
            $table->unsignedTinyInteger('aerial_duels_lost')->default(0);
            $table->unsignedTinyInteger('recoveries')->default(0);

            $table->unsignedTinyInteger('progressive_passes')->default(0);
            $table->unsignedTinyInteger('progressive_carries')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('defender_match_stats');
    }
};
