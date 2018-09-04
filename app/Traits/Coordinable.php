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

    /**
     * Dynamic scope for performing Haversine radius based search.
     *
     * @param   \Illuminate\Database\Eloquent\Builder $query
     * @param   \App\Helpers\Coordinates $coordinates
     * @param   int $radius
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHaversine($query, Coordinates $coordinates, $radius = 20)
    {
        $sql = '( 3959 * ACOS( COS( RADIANS(?) ) * COS( RADIANS( `latitude` ) ) * COS( RADIANS( `longitude` ) - RADIANS(?) ) + SIN( RADIANS(?) ) * SIN( RADIANS( `latitude` ) ) ) ) < ?';

        $latitude = $coordinates->getLatitude();
        $longitude = $coordinates->getLongitude();

        return $query->havingRaw($sql, [$latitude, $longitude, $latitude, $radius]);
    }
}