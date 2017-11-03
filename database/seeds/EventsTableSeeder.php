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
    private $count = 5;

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<$this->count; $i++) {
            $event = [
                'name' => $faker->sentence(7),
                'description' => $faker->paragraph(rand(5,7)),
                'date' => $faker->date(),
                'time' => $faker->time(),
                'public' => rand(0, 1)
            ];

            Event::create($event);
        }
    }
}
