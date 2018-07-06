<?php

use Illuminate\Database\Seeder;

final class CarsTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->cars() as $car) {

        }
    }

    /**
     * List of cars to create.
     *
     * @return  array
     */
    protected function cars()
    {
        $cars = [];
        $faker = Faker\Factory::create();

        array_push($cars, [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2008,
            'mileage' => mt_rand(1, 100000),
            'license_plate' => $faker->jpjNumberPlate
        ]);

        return $cars;
    }
}
