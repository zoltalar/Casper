<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

final class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->countries() as $country) {
            Country::firstOrCreate(array_only($country, ['name']), $country);
        }
    }

    /**
     * List of countries to create.
     *
     * @return  array
     */
    protected function countries()
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

        return $countries;
    }
}
