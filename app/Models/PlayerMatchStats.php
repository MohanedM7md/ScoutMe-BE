<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerMatchStats extends Model
{
    use HasFactory;

    protected $fillable = [
        // Match info
        'player_id',
        'football_match_id',
        'team_id',
        'played_position',
        'is_goalkeeper',
        'season_id',
        // Participation
        'minutes_played',
        'starts',
        'substitute_on_min',
        'substitute_off_min',

        // Attacking stats
        'goals',
        'assists',
        'shots_total',
        'shots_on_target',
        'shot_accuracy',
        'hit_woodwork',
        'big_chances_missed',
        'big_chances_created',
        'touches_in_box',
        'progressive_receptions',
        'dribbles_attempted',
        'dribbles_completed',
        'dribble_success_rate',
        'progressive_carries',
        'offsides',

        // Defending stats
        'tackles',
        'tackles_won',
        'tackle_success_rate',
        'interceptions',
        'clearances',
        'blocks',
        'shot_blocks',
        'recoveries',
        'aerial_duels',
        'aerial_duels_won',
        'ground_duels',
        'ground_duels_won',
        'possession',
        'possession_won',

        // General stats
        'passes_attempted',
        'passes_completed',
        'pass_accuracy',
        'progressive_passes',
        'fouls_committed',
        'fouls_suffered',
        'yellow_cards',
        'red_cards',
        'distance_covered_m',
        'distance_sprinted_m',
        'crosses_attempted',
        'crosses_completed',
        'cross_accuracy',
        'heatmap'
    ];

    protected $casts = [
        'heatmap' => 'array',
        'starts' => 'boolean',
        'match_date' => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function FootballMatch()
    {
        return $this->belongsTo(FootballMatch::class);
    }

    public function team()
    {
        return $this->belongsTo(Club::class, 'team_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'played_position', 'id');
    }

    public function goalkeeperStats()
    {
        return $this->hasOne(GoalkeeperMatchStats::class, 'id');
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    public function isGoalkeeper(): bool
    {
        return $this->played_position === 'GK';
    }
    public function getAllStatsAttribute()
    {
        $baseStats = [
            'match_info' => [
                'minutes_played' => $this->minutes_played,
                'rating' => $this->rating,
                'position' => $this->played_position,
                'is_starter' => $this->starts,
                'substitute_on' => $this->substitute_on_min,
                'substitute_off' => $this->substitute_off_min
            ],
            'attacking' => [
                'goals' => $this->goals,
                'assists' => $this->assists,
                'shots' => [
                    'total' => $this->shots_total,
                    'on_target' => $this->shots_on_target,
                    'accuracy' => $this->shot_accuracy,
                    'woodwork' => $this->hit_woodwork
                ],
                'chances' => [
                    'big_created' => $this->big_chances_created,
                    'big_missed' => $this->big_chances_missed
                ],
                'dribbles' => [
                    'attempted' => $this->dribbles_attempted,
                    'completed' => $this->dribbles_completed,
                    'success_rate' => $this->dribble_success_rate
                ],
                'progressive_actions' => [
                    'carries' => $this->progressive_carries,
                    'receptions' => $this->progressive_receptions
                ],
                'touches_in_box' => $this->touches_in_box,
                'offsides' => $this->offsides
            ],
            'defensive' => [
                'tackles' => [
                    'attempted' => $this->tackles_attempted,
                    'won' => $this->tackles_won,
                    'success_rate' => $this->tackle_success_rate
                ],
                'interceptions' => $this->interceptions,
                'clearances' => $this->clearances,
                'blocks' => [
                    'total' => $this->blocks,
                    'shots' => $this->shot_blocks
                ],
                'recoveries' => $this->recoveries,
                'aerial_duels' => [
                    'won' => $this->aerial_duels_won,
                    'lost' => $this->aerial_duels
                ],
                'ground_duels' => [
                    'won' => $this->ground_duels_won,
                    'lost' => $this->ground_duels
                ],
                'possession' => [
                    'won' => $this->possession_won,
                    'lost' => $this->possession
                ]
            ],
            'distribution' => [
                'passes' => [
                    'attempted' => $this->passes_attempted,
                    'completed' => $this->passes_completed,
                    'accuracy' => $this->pass_accuracy,
                    'progressive' => $this->progressive_passes
                ],
                'crosses' => [
                    'attempted' => $this->crosses_attempted,
                    'completed' => $this->crosses_completed,
                    'accuracy' => $this->cross_accuracy
                ]
            ],
            'physical' => [
                'distance_covered' => $this->distance_covered_m,
                'distance_sprinted' => $this->distance_sprinted_m
            ],
            'discipline' => [
                'fouls' => [
                    'committed' => $this->fouls_committed,
                    'suffered' => $this->fouls_suffered
                ],
                'cards' => [
                    'yellow' => $this->yellow_cards,
                    'red' => $this->red_cards
                ]
            ]
        ];
        if ($this->is_goalkeeper && $this->goalkeeperStats) {
            $baseStats['goalkeeping'] = [
                'saves' => [
                    'total' => $this->goalkeeperStats->saves_total,
                    'inside_box' => $this->goalkeeperStats->saves_inside_box,
                    'outside_box' => $this->goalkeeperStats->saves_outside_box
                ],
                'penalties' => [
                    'faced' => $this->goalkeeperStats->penalties_faced,
                    'saved' => $this->goalkeeperStats->penalties_saved
                ],
                'actions' => [
                    'punches' => $this->goalkeeperStats->punches,
                    'high_claims' => $this->goalkeeperStats->high_claims
                ],
                'goals_conceded' => $this->goalkeeperStats->goals_conceded,
                'clean_sheet' => $this->goalkeeperStats->clean_sheet
            ];
        }

        return $baseStats;
    }
}
