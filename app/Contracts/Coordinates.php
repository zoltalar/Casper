<?php

namespace App\Contracts;

interface Coordinates
{
    /**
     * Retrieve coordinates of an address.
     *
     * @param   string $address
     * @return  \App\Coordinates
     */
    public static function resolveAddress($address);

    /**
     * Perform search within specific radius of a coordinate.
     *
     * @param   double $latitude
     * @param   double $longitude
     * @param   int $radius
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public static function haversine($latitude, $longitude, $radius = 10);
}