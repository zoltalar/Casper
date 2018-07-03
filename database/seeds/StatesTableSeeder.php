<?php

use App\Models\Country;
use App\Models\State;
use App\Transformers\CsvRowTransformer;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * CSV files to import.
     *
     * @var array
     */
    private $files = ['poland.csv', 'usa.csv'];

    /**
     * Path where the CSV files are located.
     *
     * @var string
     */
    private $path = 'database/seeds/csv/states/';

    public function run()
    {
        $transformer = new CsvRowTransformer();
        $cache = [];

        foreach ($this->files as $file) {
            $path = base_path($this->path) . $file;

            if ( ! is_file($path)) {
                throw new Exception('States CSV file was not found');
            }

            $handle = fopen($path, 'r');
            $i = 0;

            while (($row = fgetcsv($handle)) !== false) {
                if ($i == 0) {
                    $transformer->setHeaders($row);
                } else {
                    $row = $transformer->transformItem($row);

                    if ( ! isset($cache[$row['country']])) {
                        $country = Country::where('name', $row['country'])
                            ->get()
                            ->first();

                        if ($country !== null) {
                            $cache[$row['country']] = $country->id;
                        }
                    }

                    if (isset($cache[$row['country']])) {
                        $state = [
                            'country_id' => $cache[$row['country']],
                            'name' => $row['name'],
                            'abbr' => $row['abbr']
                        ];

                        State::create($state);
                    }
                }

                $i++;
            }
        }
    }
}
