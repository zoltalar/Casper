<?php

use App\Models\Country;
use App\Models\State;
use App\Transformers\CsvRowTransformer;
use Illuminate\Database\Seeder;

final class StatesTableSeeder extends Seeder
{
    /**
     * CSV files to import.
     *
     * @var array
     */
    protected $files = ['poland.csv', 'usa.csv'];

    /**
     * Path where the CSV files are located.
     *
     * @var string
     */
    protected $path = 'database/seeds/csv/states/';

    /**
     * Country's name to country ID cache.
     *
     * @var array
     */
    protected $cache = [];

    public function run()
    {
        $transformer = new CsvRowTransformer();

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

                    if ( ! isset($this->cache[$row['country']])) {
                        $country = Country::where('name', $row['country'])
                            ->get()
                            ->first();

                        if ($country !== null) {
                            $this->cache[$row['country']] = $country->id;
                        }
                    }

                    if (isset($this->cache[$row['country']])) {
                        $state = [
                            'country_id' => $this->cache[$row['country']],
                            'name' => $row['name'],
                            'abbr' => $row['abbr']
                        ];

                        State::firstOrCreate(array_only($state, ['country_id', 'name']), $state);
                    }
                }

                $i++;
            }
        }
    }
}