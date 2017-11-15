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
     * @return  void|double|null
     */
    public function latitude($latitude = null)
    {
        if ($latitude !== null) {
            $this->latitude = $latitude;
        } else {
            return $this->latitude;
        }
    }

    /**
     * Get or set longitude.
     *
     * @param   double|null $longitude
     * @return  void|double|null
     */
    public function longitude($longitude = null)
    {
        if ($longitude !== null) {
            $this->longitude = $longitude;
        } else {
            return $this->longitude;
        }
    }

    /**
     * Determine if coordinates are empty.
     *
     * @return  bool
     */
    public function empty()
    {
        return ($this->latitude === null && $this->longitude === null);
    }
}