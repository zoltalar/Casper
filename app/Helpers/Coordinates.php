<?php

namespace App\Helpers;

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
     * Constructor.
     *
     * @param   double|null $latitude
     * @param   double|null $longitude
     */
    public function __construct($latitude = null, $longitude = null)
    {
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /**
     * Stringify class.
     *
     * @return  string
     */
    public function __toString()
    {
        return implode(', ', [$this->getLatitude(), $this->getLongitude()]);
    }

    /**
     * Get latitude.
     *
     * @return  double|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set latitude.
     *
     * @param   double $latitude
     * @return  $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return  double|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set longitude.
     *
     * @param   $longitude
     * @return  $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Determine if coordinates are empty.
     *
     * @return  bool
     */
    public function empty()
    {
        return $this->getLatitude() === null && $this->getLongitude() === null;
    }
}