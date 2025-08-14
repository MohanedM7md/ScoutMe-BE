<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\MatchTeamStats;
use App\Models\Country;
use App\Models\Position;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Scout;
use App\Models\Club;
use App\Models\FootballMatch;
use App\Models\Player;
use App\Models\League;
use App\Models\PlayerMatchStats;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Truncate all relevant tables
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        MatchTeamStats::truncate();
        Country::truncate();
        Position::truncate();
        SubscriptionPlan::truncate();
        User::truncate();
        Scout::truncate();
        Club::truncate();
        Player::truncate();
        League::truncate();
        FootballMatch::truncate();
        PlayerMatchStats::truncate();
        Schema::enableForeignKeyConstraints();
        // Seed roles
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'scout', 'guard_name' => 'web']);
        Role::create(['name' => 'player', 'guard_name' => 'web']);

        // Call other seeders
        $this->call([
            CountriesSeeder::class,
            PositionsSeeder::class,
            SubscriptionPlansSeeder::class,
            UsersSeeder::class,
            ScoutsSeeder::class,
            ClubsSeeder::class,
            PlayersSeeder::class,
            LeaguesSeeder::class,
            MatchesSeeder::class,
            MatchTeamStatsSeeder::class,
            PlayerMatchStatsSeeder::class,
        ]);
    }
}
