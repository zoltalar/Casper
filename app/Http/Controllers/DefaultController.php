<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class DefaultController extends Controller
{
    public function home()
    {
        $data = request()->all();
        $rules = Event::rules();
        $radius = array_get($data, 'radius', 10);

        $address = Event::generateAddress($data, $rules, ',');
        $coordinates = Event::resolveAddress($address);

        if ( ! $coordinates->empty()) {
            $latitude = $coordinates->latitude();
            $longitude = $coordinates->longitude();

            $events = Event::haversine($latitude, $longitude)
                ->where('date', '>=', Carbon::now()->format('Y-m-d'))
                ->orderBy('date', 'asc')
                ->simplePaginate(4);
        } else {
            $events = Event::where('public', 1)
                ->where('date', '>=', Carbon::now()->format('Y-m-d'))
                ->orderBy('date', 'asc')
                ->take(10)
                ->simplePaginate(4);
        }

        $data = compact( 'address', 'coordinates', 'events', 'radius');

        return view('default/home', $data);
    }
}
