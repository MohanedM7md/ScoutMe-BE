<?php

namespace App\Repositories;
use App\Models\FootballMatch;
use App\Models\Player;
use App\Models\PlayerMatchStats;
use App\Models\GoalkeeperMatchStats;
use Illuminate\Support\Facades\Schema;

class PlayerRepository
{

    public function getPlayerMatchStats(FootballMatch $match, Player $player){
        $playerStat = $match->playerStats()
            ->where('player_id', $player->id)
            ->with( 'position')
            ->first();
        return $playerStat;
    }

    public function getPlayerAggStats($seasonId, $playerId)
{
    $columns = Schema::getColumnListing('player_match_stats');

    $ignored = [
        'id', 'football_match_id', 'team_id', 'created_at', 'heatmap',
        'updated_at', 'deleted_at', 'season_id', 'player_id', 'played_position', 'is_goalkeeper'];

    $avgFields = [
        'shot_accuracy', 'dribble_success_rate', 'tackle_success_rate',
        'pass_accuracy', 'cross_accuracy', 'possession'
    ];

    $selects = [];
    foreach ($columns as $col) {
        if (in_array($col, $ignored)) continue;

        $selects[] = (in_array($col, $avgFields) ? "AVG(pms.$col)" : "SUM(pms.$col)") . " as $col";
    }

    // first check if this player is a goalkeeper
    $isGoalkeeper = PlayerMatchStats::where('player_id', $playerId)
        ->where('season_id', $seasonId)
        ->value('is_goalkeeper');
    
    if ($isGoalkeeper) {
        $goalkeeperColumns = Schema::getColumnListing('goalkeeper_match_stats');
        $ignoredGK = ['id', 'player_match_stat_id', 'created_at', 'updated_at', 'deleted_at'];

        foreach ($goalkeeperColumns as $col) {
            if (in_array($col, $ignoredGK)) continue;
            $selects[] = "SUM(gks.$col) as $col";
        }

        $stats = PlayerMatchStats::from('player_match_stats as pms')
            ->leftJoin('goalkeeper_match_stats as gks', 'gks.player_match_stat_id', '=', 'pms.id')
            ->where('pms.player_id', $playerId)
            ->where('pms.season_id', $seasonId)
            ->selectRaw(implode(', ', $selects))
            ->first();
    } else {
        $stats = PlayerMatchStats::from('player_match_stats as pms')
            ->where('pms.player_id', $playerId)
            ->where('pms.season_id', $seasonId)
            ->selectRaw(implode(', ', $selects))
            ->first();
    }

    return $stats ? $stats->toArray() : null;

}



}
