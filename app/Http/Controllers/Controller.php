<?php

namespace App\Http\Controllers;

use App\Helpers\Coordinates;
use App\Models\Event;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $address;
    protected $coordinates;
    protected $radius;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->vars();
            return $next($request);
        });
    }

    /**
     * Push some globally used variables to controllers and/or views.
     *
     * @return  void
     */
    protected function vars()
    {
        $this->address = session()->get('filter.event.address');

        $latitude = session()->get('filter.event.coordinates.0');
        $longitude = session()->get('filter.event.coordinates.1');

        $this->coordinates = (new Coordinates())
            ->setLatitude($latitude)
            ->setLongitude($longitude);

        $this->radius = session()->get('filter.event.radius', 5);

        view()->share([
            'address' => $this->address,
            'coordinates' => $this->coordinates,
            'radii' => Event::radii(),
            'radius' => $this->radius,
            'sidebars' => $this->sidebars()
        ]);
    }

    /**
     * Generate sidebar view name variations.
     *
     * @return  array
     */
    protected function sidebars()
    {
        $route = request()->route();
        $name = $route->getName();

        if (strpos($name, '.') !== false) {
            $prefix = explode('.', $name)[0];
        } else {
            $prefix = ltrim($route->getPrefix(), '/');
        }

        $name = str_replace('.', '-', $name);

        return array_map(function($item) {
            return 'partials.sidebar.' . $item;
        }, [$name, $prefix, 'default']);
    }
}
