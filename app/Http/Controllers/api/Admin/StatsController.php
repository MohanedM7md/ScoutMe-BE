<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeamStatsRequest;
use App\Http\Requests\Players\UpdatePlayerStatsRequest;
use App\Http\Requests\Players\UpdateGoalkeeperStatsRequest;
use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use App\Models\PlayerMatchStats;
use App\Models\GoalkeeperMatchStats;
use App\Models\Position;
use Illuminate\Http\Response;

class StatsController extends Controller
{

    public function storeTeamStats(UpdateTeamStatsRequest $request)
    {
        $exists = MatchTeamStats::where('football_match_id', $request->match_id)
            ->where('club_id', $request->club_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Team stats already exist for this match & club'
            ], Response::HTTP_CONFLICT);
        }

        $stats = MatchTeamStats::create($request->validated());

        return response()->json([
            'message' => 'Team stats created successfully',
            'data'    => $stats
        ], Response::HTTP_CREATED);
    }


    public function updateTeamStats(UpdateTeamStatsRequest $request, FootballMatch $match, int $clubId)
    {
        $stats = MatchTeamStats::where('football_match_id', $match->id)
            ->where('club_id', $clubId)
            ->firstOrFail();

        $stats->update($request->validated());

        return response()->json([
            'message' => 'Team stats updated successfully',
            'data'    => $stats
        ]);
    }


    public function storePlayerStats(UpdatePlayerStatsRequest $request)
    {
        $exists = PlayerMatchStats::where('football_match_id', $request->football_match_id)
            ->where('player_id', $request->player_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Player stats already exist for this match'
            ], Response::HTTP_CONFLICT);
        }

        $playerStat = PlayerMatchStats::create($request->validated());


        $isGoalkeeper = Position::where('id', $request->played_position)
            ->where('category', 'GK')
            ->exists();

        if ($isGoalkeeper && $request instanceof UpdateGoalkeeperStatsRequest) {
            $this->updateGoalkeeperStats($playerStat->id, $request->validated());
        }

        return response()->json([
            'message' => 'Player stats created successfully',
            'data'    => $playerStat
        ], Response::HTTP_CREATED);
    }

    public function updatePlayerStats(UpdatePlayerStatsRequest $request, FootballMatch $match, int $playerId)
    {
        $playerStat = PlayerMatchStats::where('football_match_id', $match->id)
            ->where('player_id', $playerId)
            ->firstOrFail();

        $playerStat->update($request->validated());

        // Goalkeeper check
        $isGoalkeeper = Position::where('id', $request->played_position ?? $playerStat->played_position)
            ->where('category', 'GK')
            ->exists();

        if ($isGoalkeeper && $request instanceof UpdateGoalkeeperStatsRequest) {
            $this->updateGoalkeeperStats($playerStat->id, $request->validated());
        }

        return response()->json([
            'message' => 'Player stats updated successfully',
            'data'    => $playerStat
        ]);
    }

    public function deleteTeamStats(FootballMatch $match, int $clubId)
    {
        MatchTeamStats::where('football_match_id', $match->id)
            ->where('club_id', $clubId)
            ->delete();

        return response()->json(['message' => 'Team stats deleted successfully']);
    }

    public function deletePlayerStats(FootballMatch $match, int $playerId)
    {
        PlayerMatchStats::where('football_match_id', $match->id)
            ->where('player_id', $playerId)
            ->delete();

        return response()->json(['message' => 'Player stats deleted successfully']);
    }

    protected function updateGoalkeeperStats(int $playerMatchStatId, array $data)
    {
        GoalkeeperMatchStats::updateOrCreate(
            ['player_match_stat_id' => $playerMatchStatId],
            $data
        );
    }
}
