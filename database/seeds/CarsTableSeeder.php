<?php

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        foreach ($this->cars() as $make => $models) {
            foreach ($models as $model) {
                Car::firstOrCreate(compact('make', 'model'));
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
        $cars = [
            'Audi' => ['A1', 'A3', 'A4', 'Q2'],
            'BMW' => ['1 Series', '2 Series', '3 Series', 'X1'],
            'Ford' => ['C-MAX', 'EcoSport', 'Fiesta', 'Focus', 'Kuga', 'S-MAX'],
            'Honda' => ['Civic', 'CR-V', 'HR-V', 'Jazz'],
            'Hyundai' => ['i10', 'i20', 'i30', 'ix20', 'Kona', 'Tucson'],
            'Kia' => ['Carens', 'Niro', 'Optima', 'Picanto', 'Rio', 'Soul', 'Stonic'],
            'Mazda' => ['CX-3', 'CX-5', 'Mazda2', 'Mazda3', 'MX-5'],
            'Mercedes' => ['A-Class', 'B-Class', 'CLA', 'GLA-Class'],
            'Nissan' => ['Juke', 'Micra', 'Qashqai', 'X-Trail'],
            'Peugeot' => ['108', '208', '308', 'Partner', 'Traveller'],
            'Renault' => ['Captur', 'Clio', 'Grand Scenic', 'Kadjar', 'Koleos', 'Trafic'],
            'Seat' => ['Alhambra', 'Arona', 'Ateca', 'Ibiza', 'Mii'],
            'Skoda' => ['Citigo', 'Fabia', 'Karoq', 'Octavia', 'Rapid', 'Rapid Spaceback'],
            'Suzuki' => ['Baleno', 'Celerio', 'Ignis', 'Swift', 'Vitara'],
            'Toyota' => ['Auris', 'AYGO', 'Prius', 'PROACE Verso', 'RAV4', 'Verso', 'Yaris'],
            'Volkswagen' => ['Golf', 'Passat', 'Polo', 'Sharan', 'Touran'],
            'Volvo' => ['V40', 'XC40']
        ];

        return $cars;
    }
}
