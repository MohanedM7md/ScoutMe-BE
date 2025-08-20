<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    public function definition()
    {
        $country =  Country::all();
        return [
            'player_nationality' => $this->faker->randomElement(['BR', 'ES', 'DE', 'FR']),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'display_name' => fn(array $attrs) => $attrs['first_name'][0] . '. ' . $attrs['last_name'],
            'birth_date' => $this->faker->dateTimeBetween('-40 years', '-18 years'),
            'height_cm' => $this->faker->numberBetween(160, 200),
            'weight_kg' => $this->faker->numberBetween(60, 95),
            'primary_position' => $this->faker->randomElement(['GK', 'CB', 'RB', 'LB', 'MF', 'FW']),
            'is_profile_complete' => true,
        ];
    }
}
