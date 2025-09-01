<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use App\Models\Driver;
use App\Models\CarModel;
use App\Models\Employee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Position;
use App\Models\ComfortCategory;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'Manager'],
            ['name' => 'Junior Developer'],
            ['name' => 'Designer'],
            ['name' => 'Lead Developer'],
        ];

        $comfortCategories = [
            ['name' => 'Economy'],
            ['name' => 'Business'],
            ['name' => 'Luxury'],
        ];

        $comfort_category_position = [
            ['comfort_category_id' => 1, 'position_id' => 1],
            ['comfort_category_id' => 1, 'position_id' => 2],
            ['comfort_category_id' => 2, 'position_id' => 3],
            ['comfort_category_id' => 2, 'position_id' => 4],
            ['comfort_category_id' => 3, 'position_id' => 4],
            ['comfort_category_id' => 3, 'position_id' => 1],
            ['comfort_category_id' => 3, 'position_id' => 2],
        ];

        // User::factory(10)->create();
        Driver::factory(10)->create();
        foreach ($positions as $position) {
            Position::create($position);
        }

        foreach ($comfortCategories as $category) {
            ComfortCategory::create($category);
        }

        foreach ($comfort_category_position as $ccp) {
            DB::table('comfort_categories_positions')->insert($ccp);
        }

        Employee::factory(50)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        CarModel::factory(15)->create();
        Car::factory(10)->create();
        Reservation::factory(30)->create();
    }
}
