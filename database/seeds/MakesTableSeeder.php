<?php

use App\Models\Make;
use Illuminate\Database\Seeder;

class MakesTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->makes() as $make) {
            Make::firstOrCreate(['name' => $make]);
        }
    }

    /**
     * List of makes to create.
     *
     * @return  array
     */
    protected function makes()
    {
        return [
            'Audi',
            'BMW',
            'Ford',
            'Honda',
            'Hyundai',
            'Kia',
            'Mazda',
            'Mercedes',
            'Nissan',
            'Peugeot',
            'Renault',
            'Seat',
            'Skoda',
            'Suzuki',
            'Toyota',
            'Volkswagen',
            'Volvo'
        ];
    }
}
