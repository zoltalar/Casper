<?php

use App\Constants\Colors;
use App\Models\Car;
use App\Models\Model;
use Illuminate\Database\Seeder;

final class CarsTableSeeder extends Seeder
{
    /**
     * Model's name to model's ID cache.
     *
     * @var array
     */
    protected $cache = [];

    public function run()
    {
        foreach ($this->cars() as $car) {
            $model = $car['model'];

            if ( ! isset($this->cache[$model])) {
                $_model = Model::whereName($model)->first();

                if ($_model !== null) {
                    $this->cache[$model] = $_model->id;
                }
            }

            if (isset($this->cache[$model])) {
                $car = ['model_id' => $this->cache[$model]] + array_only($car, ['year', 'mileage', 'license_plate', 'color']);
                Car::create($car);
            }
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
        $colors = collect(Colors::COLORS);

        array_push($cars, [
            'model' => 'Camry',
            'year' => $faker->date('Y', '-10 years'),
            'mileage' => $this->mileage(),
            'license_plate' => $this->licensePlate(),
            'color' => $colors->random()
        ]);

        array_push($cars, [
            'model' => 'A4',
            'year' => $faker->date('Y', '-10 years'),
            'mileage' => $this->mileage(),
            'license_plate' => $this->licensePlate(),
            'color' => $colors->random()
        ]);

        array_push($cars, [
            'model' => 'i20',
            'year' => $faker->date('Y', '-10 years'),
            'mileage' => $this->mileage(),
            'license_plate' => $this->licensePlate(),
            'color' => $colors->random()
        ]);

        array_push($cars, [
            'model' => 'MX-5',
            'year' => $faker->date('Y', '-10 years'),
            'mileage' => $this->mileage(),
            'license_plate' => $this->licensePlate(),
            'color' => $colors->random()
        ]);

        array_push($cars, [
            'model' => 'Polo',
            'year' => $faker->date('Y', '-10 years'),
            'mileage' => $this->mileage(),
            'license_plate' => $this->licensePlate(),
            'color' => $colors->random()
        ]);

        return $cars;
    }

    /**
     * Generate random mileage number.
     *
     * @return  int
     */
    protected function mileage()
    {
        return mt_rand(1, 100000);
    }

    /**
     * Generate random license plate.
     *
     * @return  string
     */
    protected function licensePlate()
    {
        return str_random(7);
    }
}
