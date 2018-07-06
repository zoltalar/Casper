<?php

use App\Models\Make;
use App\Models\Model;
use Illuminate\Database\Seeder;

final class ModelsTableSeeder extends Seeder
{
    /**
     * Make's name to make's ID cache.
     *
     * @var array
     */
    protected $cache = [];

    public function run()
    {
        foreach ($this->models() as $make => $models) {
            foreach ($models as $model) {
                if ( ! isset($this->cache[$make])) {
                    $_make = Make::whereName($make)->first();

                    if ($_make !== null) {
                        $this->cache[$make] = $_make->id;
                    }
                }

                if (isset($this->cache[$make])) {
                    $id = $this->cache[$make];
                    Model::firstOrCreate(['make_id' => $id, 'name' => $model]);
                }
            }
        }
    }

    /**
     * List of car models to create.
     *
     * @return  array
     */
    protected function models()
    {
        return [
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
            'Toyota' => ['Auris', 'AYGO', 'Camry', 'Prius', 'PROACE Verso', 'RAV4', 'Verso', 'Yaris'],
            'Volkswagen' => ['Golf', 'Passat', 'Polo', 'Sharan', 'Touran'],
            'Volvo' => ['V40', 'XC40']
        ];
    }
}