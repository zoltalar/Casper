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
        $faker = Faker\Factory::create();

        for ($i=0; $i<$this->count; $i++) {
            $address = $this->addresses(true);

            $event = [
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
            ];

            Event::create($event);
        }
    }

    /**
     * Retrieve single or a list of real addresses.
     *
     * @param   boolean $random generate random address
     * @return  array
     */
    public function addresses($random = false)
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

        $collection = collect($addresses);

        if ($random) {
            return $collection->random();
        }

        return $collection;
    }
}
