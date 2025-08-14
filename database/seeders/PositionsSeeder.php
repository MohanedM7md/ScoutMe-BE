<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['id' => 'GK', 'full_name' => 'Goalkeeper', 'category' => 'goalkeeper'],
            ['id' => 'CB', 'full_name' => 'Center Back', 'category' => 'defender'],
            ['id' => 'LB', 'full_name' => 'Left Back', 'category' => 'defender'],
            ['id' => 'RB', 'full_name' => 'Right Back', 'category' => 'defender'],
            ['id' => 'CM', 'full_name' => 'Central Midfielder', 'category' => 'midfielder'],
            ['id' => 'CDM', 'full_name' => 'Defensive Midfielder', 'category' => 'midfielder'],
            ['id' => 'CAM', 'full_name' => 'Attacking Midfielder', 'category' => 'midfielder'],
            ['id' => 'LW', 'full_name' => 'Left Winger', 'category' => 'attacker'],
            ['id' => 'RW', 'full_name' => 'Right Winger', 'category' => 'attacker'],
            ['id' => 'ST', 'full_name' => 'Striker', 'category' => 'attacker'],
            ['id' => 'FW', 'full_name' => 'Forward', 'category' => 'attacker'],
            ['id' => 'MF', 'full_name' => 'Midfielder', 'category' => 'midfielder'],
        ];


        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
