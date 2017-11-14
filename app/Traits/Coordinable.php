<?php

namespace App\Traits;

use App\Contracts\Address;

trait Coordinable
{
    /**
     * Boot coordinable trait for a model.
     *
     * @return  void
     */
    public static function bootCoordinable()
    {
        // Register model events to listen to
        static::saving(function($model) {
            if ($model instanceof Address) {
                $coordinates = $model->resolve($model->address(','));

                $model->latitude = $coordinates[0];
                $model->longitude = $coordinates[1];
            }
        });
    }

    public function resolve($address)
    {
        $coordinates = [null, null];

        $contents = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . urlencode($address));
        $response = json_decode($contents);

        if (isset($response->results[0]->geometry->location)) {
            $location = $response->results[0]->geometry->location;

            $coordinates = [
                $location->lat,
                $location->lng
            ];
        }

        return $coordinates;
    }

    public static function haversine($latitude, $longitude, $radius = 10)
    {
        $formula = '( 3959 * acos( cos( radians(?) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians(?) ) + sin( radians(?) ) * sin( radians( `latitude` ) ) ) ) AS `distance`';

        $models = static::select('*')
            ->selectRaw($formula, [$latitude, $longitude, $latitude])
            ->havingRaw('`distance` < ?', [$radius]);

        return $models;
    }
}