<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nif' => $this->faker->unique()->regexify('[A-Za-z0-9]{9}'),
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'direccion' => $this->faker->text(30),
            'email' => $this->faker->unique()->safeEmail(),
            'tarjeta' => $this->faker->regexify('[0-9]{16}'),
            // 'created_at' => now(),
            // 'updated_at' => now()
        ];
    }
}
