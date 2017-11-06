<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Number of events to generate.
     *
     * @var int
     */
    private $count = 10;

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<$this->count; $i++) {
            $event = [
                'name' => $faker->sentence(7),
                'description' => $faker->paragraph(rand(40,50)),
                'date' => $faker->dateTimeBetween('now', '+4 years')->format('Y-m-d'),
                'time' => $faker->time(),
                'public' => rand(0, 1)
            ];

            Event::create($event);
        }
    }
}
