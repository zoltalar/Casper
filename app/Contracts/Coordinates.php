<?php

namespace App\Contracts;

interface Coordinates
{
    /**
     * Resolve address to latitude and longitude.
     *
     * @param   string $address
     * @return  array
     */
    public function resolve($address);

    /**
     * Perform search within specific radius.
     *
     * @param   double $latitude
     * @param   double $longitude
     * @param   int $radius
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public static function haversine($latitude, $longitude, $radius = 10);
}