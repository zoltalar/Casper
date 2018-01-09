<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $radii = Event::radii();

        view()->share('address', null);
        view()->share('coordinates', null);
        view()->share('radii', $radii);
        view()->share('radius', 10);
    }
}
