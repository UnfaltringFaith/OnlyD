<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $letters = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Э', 'Ю', 'Я'];

        return [
            'registration_number' => mb_strtolower($this->faker->randomElement($letters)) . str_pad($this->faker->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT) . mb_strtolower(implode('', $this->faker->randomElements($letters, 2, false))),
            'car_model_id' => CarModel::inRandomOrder()->first()->id,
            'driver_id' => Driver::inRandomOrder()->first()->id,
        ];
    }
}
