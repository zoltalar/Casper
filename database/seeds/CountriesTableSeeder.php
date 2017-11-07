<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [];

        array_push($countries, [
            'name' => 'Poland',
            'code' => 'pl'
        ]);

        array_push($countries, [
            'name' => 'United States',
            'code' => 'us'
        ]);

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
