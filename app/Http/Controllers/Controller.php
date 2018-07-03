<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\AddressGeneratorService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        $address = (new AddressGeneratorService(session()->get('filter.event', [])))->get(',');

        view()->share([
            'address' => $address,
            'coordinates' => null,
            'radii' => Event::radii(),
            'radius' => 5
        ]);
    }
}
