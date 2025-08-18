<?php

namespace Database\Seeders;

use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            ['player_nationality' => 'DE', 'first_name' => 'Lionel', 'last_name' => 'Messi', 'display_name' => 'L. Messi', 'birth_date' => Carbon::create(1987, 6, 24), 'height_cm' => 170, 'weight_kg' => 72, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Cristiano', 'last_name' => 'Ronaldo', 'display_name' => 'CR7', 'birth_date' => Carbon::create(1985, 2, 5), 'height_cm' => 187, 'weight_kg' => 83, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Kevin', 'last_name' => 'De Bruyne', 'display_name' => 'K. De Bruyne', 'birth_date' => Carbon::create(1991, 6, 28), 'height_cm' => 181, 'weight_kg' => 70, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Manuel', 'last_name' => 'Neuer', 'display_name' => 'M. Neuer', 'birth_date' => Carbon::create(1986, 3, 27), 'height_cm' => 193, 'weight_kg' => 92, 'primary_position' => 'GK', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Sergio', 'last_name' => 'Ramos', 'display_name' => 'S. Ramos', 'birth_date' => Carbon::create(1986, 3, 30), 'height_cm' => 184, 'weight_kg' => 82, 'primary_position' => 'CB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Virgil', 'last_name' => 'van Dijk', 'display_name' => 'V. van Dijk', 'birth_date' => Carbon::create(1991, 7, 8), 'height_cm' => 193, 'weight_kg' => 92, 'primary_position' => 'CB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Trent', 'last_name' => 'Alexander-Arnold', 'display_name' => 'TAA', 'birth_date' => Carbon::create(1998, 10, 7), 'height_cm' => 175, 'weight_kg' => 69, 'primary_position' => 'RB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Andrew', 'last_name' => 'Robertson', 'display_name' => 'A. Robertson', 'birth_date' => Carbon::create(1994, 3, 11), 'height_cm' => 178, 'weight_kg' => 68, 'primary_position' => 'LB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Kylian', 'last_name' => 'Mbappé', 'display_name' => 'K. Mbappé', 'birth_date' => Carbon::create(1998, 12, 20), 'height_cm' => 178, 'weight_kg' => 73, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Erling', 'last_name' => 'Haaland', 'display_name' => 'E. Haaland', 'birth_date' => Carbon::create(2000, 7, 21), 'height_cm' => 194, 'weight_kg' => 88, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Karim', 'last_name' => 'Benzema', 'display_name' => 'K. Benzema', 'birth_date' => Carbon::create(1987, 12, 19), 'height_cm' => 185, 'weight_kg' => 81, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Robert', 'last_name' => 'Lewandowski', 'display_name' => 'R. Lewandowski', 'birth_date' => Carbon::create(1988, 8, 21), 'height_cm' => 185, 'weight_kg' => 81, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Mohamed', 'last_name' => 'Salah', 'display_name' => 'M. Salah', 'birth_date' => Carbon::create(1992, 6, 15), 'height_cm' => 175, 'weight_kg' => 71, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Sadio', 'last_name' => 'Mané', 'display_name' => 'S. Mané', 'birth_date' => Carbon::create(1992, 4, 10), 'height_cm' => 174, 'weight_kg' => 69, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Neymar', 'last_name' => 'Jr', 'display_name' => 'Neymar', 'birth_date' => Carbon::create(1992, 2, 5), 'height_cm' => 175, 'weight_kg' => 68, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Harry', 'last_name' => 'Kane', 'display_name' => 'H. Kane', 'birth_date' => Carbon::create(1993, 7, 28), 'height_cm' => 188, 'weight_kg' => 86, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Joshua', 'last_name' => 'Kimmich', 'display_name' => 'J. Kimmich', 'birth_date' => Carbon::create(1995, 2, 8), 'height_cm' => 176, 'weight_kg' => 73, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Toni', 'last_name' => 'Kroos', 'display_name' => 'T. Kroos', 'birth_date' => Carbon::create(1990, 1, 4), 'height_cm' => 183, 'weight_kg' => 76, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Luka', 'last_name' => 'Modrić', 'display_name' => 'L. Modrić', 'birth_date' => Carbon::create(1985, 9, 9), 'height_cm' => 172, 'weight_kg' => 66, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Casemiro', 'last_name' => '', 'display_name' => 'Casemiro', 'birth_date' => Carbon::create(1992, 2, 23), 'height_cm' => 185, 'weight_kg' => 84, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Frenkie', 'last_name' => 'de Jong', 'display_name' => 'F. de Jong', 'birth_date' => Carbon::create(1997, 5, 12), 'height_cm' => 180, 'weight_kg' => 74, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Pedri', 'last_name' => '', 'display_name' => 'Pedri', 'birth_date' => Carbon::create(2002, 11, 25), 'height_cm' => 174, 'weight_kg' => 60, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Gavi', 'last_name' => '', 'display_name' => 'Gavi', 'birth_date' => Carbon::create(2004, 8, 5), 'height_cm' => 173, 'weight_kg' => 70, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Jude', 'last_name' => 'Bellingham', 'display_name' => 'J. Bellingham', 'birth_date' => Carbon::create(2003, 6, 29), 'height_cm' => 186, 'weight_kg' => 75, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Thibaut', 'last_name' => 'Courtois', 'display_name' => 'T. Courtois', 'birth_date' => Carbon::create(1992, 5, 11), 'height_cm' => 199, 'weight_kg' => 96, 'primary_position' => 'GK', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Alisson', 'last_name' => 'Becker', 'display_name' => 'Alisson', 'birth_date' => Carbon::create(1992, 10, 2), 'height_cm' => 193, 'weight_kg' => 91, 'primary_position' => 'GK', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Ederson', 'last_name' => '', 'display_name' => 'Ederson', 'birth_date' => Carbon::create(1993, 8, 17), 'height_cm' => 188, 'weight_kg' => 86, 'primary_position' => 'GK', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Marc-André', 'last_name' => 'ter Stegen', 'display_name' => 'M. ter Stegen', 'birth_date' => Carbon::create(1992, 4, 30), 'height_cm' => 187, 'weight_kg' => 85, 'primary_position' => 'GK', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Jan', 'last_name' => 'Oblak', 'display_name' => 'J. Oblak', 'birth_date' => Carbon::create(1993, 1, 7), 'height_cm' => 188, 'weight_kg' => 87, 'primary_position' => 'GK', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Rúben', 'last_name' => 'Dias', 'display_name' => 'R. Dias', 'birth_date' => Carbon::create(1997, 5, 14), 'height_cm' => 187, 'weight_kg' => 82, 'primary_position' => 'CB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Marquinhos', 'last_name' => '', 'display_name' => 'Marquinhos', 'birth_date' => Carbon::create(1994, 5, 14), 'height_cm' => 183, 'weight_kg' => 75, 'primary_position' => 'CB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Raphaël', 'last_name' => 'Varane', 'display_name' => 'R. Varane', 'birth_date' => Carbon::create(1993, 4, 25), 'height_cm' => 191, 'weight_kg' => 81, 'primary_position' => 'CB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Achraf', 'last_name' => 'Hakimi', 'display_name' => 'A. Hakimi', 'birth_date' => Carbon::create(1998, 11, 4), 'height_cm' => 181, 'weight_kg' => 73, 'primary_position' => 'RB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'João', 'last_name' => 'Cancelo', 'display_name' => 'J. Cancelo', 'birth_date' => Carbon::create(1994, 5, 27), 'height_cm' => 182, 'weight_kg' => 74, 'primary_position' => 'RB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Kyle', 'last_name' => 'Walker', 'display_name' => 'K. Walker', 'birth_date' => Carbon::create(1990, 5, 28), 'height_cm' => 183, 'weight_kg' => 83, 'primary_position' => 'RB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Jordi', 'last_name' => 'Alba', 'display_name' => 'J. Alba', 'birth_date' => Carbon::create(1989, 3, 21), 'height_cm' => 170, 'weight_kg' => 68, 'primary_position' => 'LB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Theo', 'last_name' => 'Hernández', 'display_name' => 'T. Hernández', 'birth_date' => Carbon::create(1997, 10, 6), 'height_cm' => 184, 'weight_kg' => 81, 'primary_position' => 'LB', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Phil', 'last_name' => 'Foden', 'display_name' => 'P. Foden', 'birth_date' => Carbon::create(2000, 5, 28), 'height_cm' => 171, 'weight_kg' => 70, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Bernardo', 'last_name' => 'Silva', 'display_name' => 'B. Silva', 'birth_date' => Carbon::create(1994, 8, 10), 'height_cm' => 173, 'weight_kg' => 64, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Bruno', 'last_name' => 'Fernandes', 'display_name' => 'B. Fernandes', 'birth_date' => Carbon::create(1994, 9, 8), 'height_cm' => 179, 'weight_kg' => 69, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Jack', 'last_name' => 'Grealish', 'display_name' => 'J. Grealish', 'birth_date' => Carbon::create(1995, 9, 10), 'height_cm' => 180, 'weight_kg' => 76, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Marcus', 'last_name' => 'Rashford', 'display_name' => 'M. Rashford', 'birth_date' => Carbon::create(1997, 10, 31), 'height_cm' => 185, 'weight_kg' => 70, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Antoine', 'last_name' => 'Griezmann', 'display_name' => 'A. Griezmann', 'birth_date' => Carbon::create(1991, 3, 21), 'height_cm' => 176, 'weight_kg' => 73, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Ousmane', 'last_name' => 'Dembélé', 'display_name' => 'O. Dembélé', 'birth_date' => Carbon::create(1997, 5, 15), 'height_cm' => 178, 'weight_kg' => 67, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Vinicius', 'last_name' => 'Jr', 'display_name' => 'Vini Jr', 'birth_date' => Carbon::create(2000, 7, 12), 'height_cm' => 176, 'weight_kg' => 73, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Rodrygo', 'last_name' => '', 'display_name' => 'Rodrygo', 'birth_date' => Carbon::create(2001, 1, 9), 'height_cm' => 174, 'weight_kg' => 68, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Jamal', 'last_name' => 'Musiala', 'display_name' => 'J. Musiala', 'birth_date' => Carbon::create(2003, 2, 26), 'height_cm' => 184, 'weight_kg' => 75, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Bukayo', 'last_name' => 'Saka', 'display_name' => 'B. Saka', 'birth_date' => Carbon::create(2001, 9, 5), 'height_cm' => 178, 'weight_kg' => 72, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Martin', 'last_name' => 'Ødegaard', 'display_name' => 'M. Ødegaard', 'birth_date' => Carbon::create(1998, 12, 17), 'height_cm' => 178, 'weight_kg' => 68, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Declan', 'last_name' => 'Rice', 'display_name' => 'D. Rice', 'birth_date' => Carbon::create(1999, 1, 14), 'height_cm' => 185, 'weight_kg' => 80, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Enzo', 'last_name' => 'Fernández', 'display_name' => 'E. Fernández', 'birth_date' => Carbon::create(2001, 1, 17), 'height_cm' => 178, 'weight_kg' => 77, 'primary_position' => 'MF', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Khvicha', 'last_name' => 'Kvaratskhelia', 'display_name' => 'K. Kvaratskhelia', 'birth_date' => Carbon::create(2001, 2, 12), 'height_cm' => 183, 'weight_kg' => 75, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Victor', 'last_name' => 'Osimhen', 'display_name' => 'V. Osimhen', 'birth_date' => Carbon::create(1998, 12, 29), 'height_cm' => 186, 'weight_kg' => 78, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Lautaro', 'last_name' => 'Martínez', 'display_name' => 'L. Martínez', 'birth_date' => Carbon::create(1997, 8, 22), 'height_cm' => 174, 'weight_kg' => 72, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Rafael', 'last_name' => 'Leão', 'display_name' => 'R. Leão', 'birth_date' => Carbon::create(1999, 6, 10), 'height_cm' => 188, 'weight_kg' => 81, 'primary_position' => 'FW', 'is_profile_complete' => true],
            ['player_nationality' => 'DE', 'first_name' => 'Dušan', 'last_name' => 'Vlahović', 'display_name' => 'D. Vlahović', 'birth_date' => Carbon::create(2000, 1, 28), 'height_cm' => 190, 'weight_kg' => 85, 'primary_position' => 'FW', 'is_profile_complete' => true],
        ];

        // If you want, you can repeat some patterns to reach 50 exactly


        foreach ($players as $playerData) {
            Player::create($playerData);
        }
    }
}
