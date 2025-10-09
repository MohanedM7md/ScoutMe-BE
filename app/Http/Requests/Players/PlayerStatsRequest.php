<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;

class PlayerStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // adjust if you want to restrict
    }

    public function rules(): array
    {
        return [
            // General
            'minutesPlayed'        => 'nullable|integer|min:0',
            'rating'               => 'nullable|numeric|min:0|max:10',
            'position'             => 'nullable|string|max:5',
            'isStarter'            => 'nullable|boolean',
            'substituteOnMin'      => 'nullable|integer|min:0',
            'substituteOffMin'     => 'nullable|integer|min:0',

            // Goals & Assists
            'goals'                => 'nullable|integer|min:0',
            'assists'              => 'nullable|integer|min:0',

            // Shooting
            'shotsTotal'           => 'nullable|integer|min:0',
            'shotsOnTarget'        => 'nullable|integer|min:0',
            'shotAccuracy'         => 'nullable|numeric|min:0|max:100',
            'hitWoodwork'          => 'nullable|integer|min:0',
            'bigChancesCreated'    => 'nullable|integer|min:0',
            'bigChancesMissed'     => 'nullable|integer|min:0',

            // Dribbling & Carrying
            'touchesInBox'         => 'nullable|integer|min:0',
            'progressiveCarries'   => 'nullable|integer|min:0',
            'progressiveReceptions'=> 'nullable|integer|min:0',
            'dribblesAttempted'    => 'nullable|integer|min:0',
            'dribblesCompleted'    => 'nullable|integer|min:0',
            'dribbleSuccessRate'   => 'nullable|numeric|min:0|max:100',

            // Offsides
            'offsides'             => 'nullable|integer|min:0',

            // Tackling & Defending
            'tacklesAttempted'     => 'nullable|integer|min:0',
            'tacklesWon'           => 'nullable|integer|min:0',
            'tackleSuccessRate'    => 'nullable|numeric|min:0|max:100',
            'interceptions'        => 'nullable|integer|min:0',
            'clearances'           => 'nullable|integer|min:0',
            'blocks'               => 'nullable|integer|min:0',
            'shotBlocks'           => 'nullable|integer|min:0',
            'recoveries'           => 'nullable|integer|min:0',

            // Duels
            'groundDuels'          => 'nullable|integer|min:0',
            'groundDuelsWon'       => 'nullable|integer|min:0',
            'aerialDuels'          => 'nullable|integer|min:0',
            'aerialDuelsWon'       => 'nullable|integer|min:0',

            // Possession & Passing
            'possession'           => 'nullable|numeric|min:0|max:100',
            'possessionWon'        => 'nullable|integer|min:0',
            'passesAttempted'      => 'nullable|integer|min:0',
            'passesCompleted'      => 'nullable|integer|min:0',
            'passAccuracy'         => 'nullable|numeric|min:0|max:100',
            'progressivePasses'    => 'nullable|integer|min:0',
            'crossesAttempted'     => 'nullable|integer|min:0',
            'crossesCompleted'     => 'nullable|integer|min:0',
            'crossAccuracy'        => 'nullable|numeric|min:0|max:100',

            // Fouls & Cards
            'foulsCommitted'       => 'nullable|integer|min:0',
            'foulsSuffered'        => 'nullable|integer|min:0',
            'yellowCards'          => 'nullable|integer|min:0',
            'redCards'             => 'nullable|integer|min:0',

            // Physical / Distance
            'distanceCoveredM'     => 'nullable|integer|min:0',
            'distanceSprintedM'    => 'nullable|integer|min:0',

            // Goalkeeping
            'savesTotal'           => 'nullable|integer|min:0',
            'savesInsideBox'       => 'nullable|integer|min:0',
            'savesOutsideBox'      => 'nullable|integer|min:0',
            'penaltiesFaced'       => 'nullable|integer|min:0',
            'penaltiesSaved'       => 'nullable|integer|min:0',
            'punches'              => 'nullable|integer|min:0',
            'highClaims'           => 'nullable|integer|min:0',
            'goalsConceded'        => 'nullable|integer|min:0',
            'cleanSheet'           => 'nullable|boolean',
        ];
    }
}
