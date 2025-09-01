<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $starts_at = $this->faker->dateTimeBetween('-1 hour', '+2 days');
        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'car_id' => Car::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'starts_at' => $starts_at,
            'finishes_at' => $this->faker->dateTimeBetween(clone ($starts_at)->modify('+30 minutes'), (clone $starts_at)->modify('+2 hours')),
        ];
    }
}
