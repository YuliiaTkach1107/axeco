<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Employe::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),

            'position' => $this->faker->randomElement([
                'Directeur',
                'Agent immobilier',
                'Assistant',
                'Manager',
                'Consultant',
            ]),

            'email' => $this->faker->optional()->safeEmail(),

            'telephone' => $this->faker->optional()->phoneNumber(),

            'departement' => $this->faker->randomElement([
                'Direction',
                'Ventes',
                'Marketing',
                'Support',
            ]),
            'avatar' => 'https://picsum.photos/seed/'.$this->faker->unique()->numberBetween(1, 1000).'/200/200',
        ];

    }
}
