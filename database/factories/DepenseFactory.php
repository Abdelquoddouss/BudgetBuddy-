<?php

namespace Database\Factories;

use App\Models\Depense;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Depense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 3, // Vous pouvez remplacer ceci par des IDs d'utilisateurs dynamiques selon vos besoins
            'description' => $this->faker->sentence,
            'prix' => $this->faker->numberBetween(10, 1000),
            'date' => $this->faker->date(),
            // Ajoutez d'autres attributs au besoin
        ];
    }
}
