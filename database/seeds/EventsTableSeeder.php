<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

final class EventsTableSeeder extends Seeder
{
    /**
     * Number of events to create.
     *
     * @var int
     */
    protected $count = 10;

    public function run()
    {
        foreach ($this->events() as $event) {
            Event::create($event);
        }
    }

    /**
     * List of events to create.
     *
     * @return  array
     */
    protected function events()
    {
        $events = [];

        if ($this->count > 0) {
            $faker = Faker\Factory::create();

            for ($i=0; $i<$this->count; $i++) {
                $address = $this->addresses(true);

                array_push($events, [
                    'name' => $faker->sentence(7),
                    'description' => $faker->paragraphs(rand(5,8), true),
                    'date' => $faker->dateTimeBetween('now', '+4 years')->format('Y-m-d'),
                    'time' => $faker->time(),
                    'public' => 1,
                    'address' => array_get($address, 'address'),
                    'address_2' => array_get($address, 'address_2'),
                    'city' => array_get($address, 'city'),
                    'state_id' => array_get($address, 'state_id'),
                    'postal_code' => array_get($address, 'postal_code')
                ]);
            }
        }

        return $events;
    }

    /**
     * Retrieve single or a list of real addresses.
     *
     * @param   boolean $random generate random real address
     * @return  array
     */
    protected function addresses($random = false)
    {
        $addresses = [];

        array_push($addresses, [
            'address' => '100 Allyn Street',
            'address_2' => '2nd Floor',
            'city' => 'Hartford',
            'state_id' => 23,
            'postal_code' => '06103'
        ]);

        array_push($addresses, [
            'address' => '40 Tower Lane',
            'city' => 'Avon',
            'state_id' => 23,
            'postal_code' => '06001'
        ]);

        array_push($addresses, [
            'address' => '234 Church Street',
            'city' => 'New Haven',
            'state_id' => 23,
            'postal_code' => '06510'
        ]);

        array_push($addresses, [
            'address' => 'Grójecka Street 1/3',
            'city' => 'Warszawa',
            'state_id' => 7,
            'postal_code' => '02019'
        ]);

        array_push($addresses, [
            'address' => 'Długa Street 17a',
            'city' => 'Kraków',
            'state_id' => 6,
            'postal_code' => '31147'
        ]);

        if ($random) {
            shuffle($addresses);
            return $addresses[mt_rand(0, count($addresses) - 1)];
        }

        return $addresses;
    }
}
