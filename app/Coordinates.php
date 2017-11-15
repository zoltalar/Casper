<?php

namespace App;

class Coordinates
{
    /**
     * Latitude.
     *
     * @var double|null
     */
    protected $latitude = null;

    /**
     * Longitude.
     *
     * @var double|null
     */
    protected $longitude = null;

    /**
     * Coordinates constructor.
     *
     * @param   double|null $latitude
     * @param   double|null $longitude
     */
    public function __construct($latitude = null, $longitude = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $latitude;
    }

    /**
     * Stringify class.
     *
     * @return  string
     */
    public function __toString()
    {
        return implode(', ', [$this->latitude, $this->longitude]);
    }

    /**
     * Get or set latitude.
     *
     * @param   double|null $latitude
     * @return  \App\Coordinates|double|null
     */
    public function latitude($latitude = null)
    {
        if ($latitude !== null) {
            $this->latitude = $latitude;
            return $this;
        }

        return $this->latitude;
    }

    /**
     * Get or set longitude.
     *
     * @param   double|null $longitude
     * @return  \App\Coordinates|double|null
     */
    public function longitude($longitude = null)
    {
        if ($longitude !== null) {
            $this->longitude = $longitude;
            return $this;
        }

        return $this->longitude;
    }
}