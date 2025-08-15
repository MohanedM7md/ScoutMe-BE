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
use App\Models\AttackerMatchStats;
use App\Models\DefenderMatchStats;
use App\Models\GoalkeeperMatchStats;
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
        // Truncate attacker, defender, and goal keeper stats tables
        AttackerMatchStats::truncate();
        DefenderMatchStats::truncate();
        GoalkeeperMatchStats::truncate();
        Schema::enableForeignKeyConstraints();
        // Seed roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'scout']);
        Role::create(['name' => 'player']);

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
