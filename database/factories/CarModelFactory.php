<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarModel>
 */
class CarModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carModels = [
            'Lada Granta',
            'Toyota Camry',
            'Hyundai Solaris',
            'Kia Rio',
            'Volkswagen Polo',
            'Renault Logan',
            'Skoda Octavia',
            'Mazda 3',
            'Ford Focus',
            'Nissan Qashqai',
            'BMW 3 Series',
            'Mercedes-Benz C-Class',
            'Audi A4',
            'Honda Civic',
            'Chevrolet Cruze',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($carModels),
            'comfort_category_id' => ComfortCategory::inRandomOrder()->first()->id,
        ];
    }
}
