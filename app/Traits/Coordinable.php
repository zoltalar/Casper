<?php

namespace App\Traits;

use App\Contracts\Address;
use App\Coordinates;

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
                $address = $model->address(',');
                $coordinates = $model->resolveAddress($address);

                $model->latitude = $coordinates->latitude();
                $model->longitude = $coordinates->longitude();
            }
        });
    }

    public static function resolveAddress($address)
    {
        $coordinates = new Coordinates();

        if ( ! empty($address)) {
            $url = 'https://maps.google.com/maps/api/geocode/json?address=' . urlencode($address);

            if ($contents = file_get_contents($url)) {
                $response = json_decode($contents);

                if (isset($response->results[0]->geometry->location)) {
                    $location = $response->results[0]->geometry->location;

                    $coordinates->latitude($location->lat);
                    $coordinates->longitude($location->lng);
                }
            }
        }

        return $coordinates;
    }

    public static function haversine($latitude, $longitude, $radius = 20)
    {
        $formula = '( 3959 * acos( cos( radians(?) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians(?) ) + sin( radians(?) ) * sin( radians( `latitude` ) ) ) ) AS `distance`';

        $models = static::select('*')
            ->selectRaw($formula, [$latitude, $longitude, $latitude])
            ->havingRaw('`distance` < ?', [$radius]);

        return $models;
    }
}