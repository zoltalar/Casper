<?php

namespace App\Services;

use App\Helpers\Coordinates;

class CoordinatesResolverService
{
    /**
     * Address to resolve.
     *
     * @var string
     */
    protected $address;

    /**
     * Constructor.
     *
     * @param   string $address
     */
    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * URL for retrieving coordinates information.
     *
     * @return  string
     */
    protected function url()
    {
        return sprintf(
            'https://maps.google.com/maps/api/geocode/json?address=%s&key=%s',
            urlencode($this->address),
            urlencode(env('GOOGLE_MAPS_API_KEY'))
        );
    }

    /**
     * Retrieve address coordinates.
     *
     * @return  \App\Helpers\Coordinates
     */
    public function resolve()
    {
        $coordinates = new Coordinates();

        if ( ! empty($this->address)) {
            $options = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]];

            if ($contents = file_get_contents($this->url(), false, stream_context_create($options))) {
                $response = json_decode($contents);

                if (isset($response->results[0]->geometry->location)) {
                    $location = $response->results[0]->geometry->location;

                    $coordinates->setLatitude($location->lat);
                    $coordinates->setLongitude($location->lng);
                }
            }
        }

        return $coordinates;
    }
}