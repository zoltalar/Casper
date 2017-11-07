<?php

use App\Models\Country;
use App\Models\Event;
use App\Models\State;
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
        $faker = Faker\Factory::create('pl_PL');
        $states = State::where('country_id', Country::ID_POLAND)->get();
        $state = null;

        for ($i=0; $i<$this->count; $i++) {
            if ($states->count() > 0) {
                $state = $states->random();
            }

            $event = [
                'name' => $faker->sentence(7),
                'description' => $faker->paragraph(rand(40,50)),
                'date' => $faker->dateTimeBetween('now', '+4 years')->format('Y-m-d'),
                'time' => $faker->time(),
                'public' => 1,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state_id' => ($state !== null ? $state->id : null),
                'postal_code' => $faker->postcode
            ];

            Event::create($event);
        }
    }
}
