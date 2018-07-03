<?php

namespace App\Traits;

use App\Contracts\Address;
use App\Helpers\Coordinates;
use App\Services\CoordinatesResolverService;

trait Coordinable
{
    /**
     * Boot coordinable trait for a model.
     *
     * @return  void
     */
    public static function bootCoordinable()
    {
        static::saving(function($model) {
            if ($model instanceof Address) {
                $coordinates = (new CoordinatesResolverService($model->address(',')))->resolve();

                $model->latitude = $coordinates->getLatitude();
                $model->longitude = $coordinates->getLongitude();
            }
        });
    }

    public function scopeHaversine($query, Coordinates $coordinates, $radius = 20)
    {
        return $query;
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