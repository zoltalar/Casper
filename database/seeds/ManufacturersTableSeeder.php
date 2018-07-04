<?php

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->manufacturers() as $manufacturer) {
            Manufacturer::firstOrCreate(['name' => $manufacturer]);
        }
    }

    /**
     * List of manufacturers to create.
     *
     * @return  array
     */
    protected function manufacturers()
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
