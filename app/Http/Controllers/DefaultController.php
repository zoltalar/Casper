<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class DefaultController extends Controller
{
    public function home()
    {
        $data = request()->all();
        $radius = array_get($data, 'radius', 5);
        //$address = Event::generateAddress($data, ',');
        //$coordinates = Event::resolveAddress($address);

        if (false /*! $coordinates->empty()*/) {
            $latitude = $coordinates->latitude();
            $longitude = $coordinates->longitude();

            $events = Event::haversine($latitude, $longitude);
        } else {
            $events = Event::where('id', '>', 0)->take(10);
        }

        $events->where('date', '>=', Carbon::now()->format('Y-m-d'));

        if (auth()->guest()) {
            $events->where('public', 1);
        }

        $events->orderBy('date', 'asc');
        $events = $events->simplePaginate(4);

        $data = compact('coordinates', 'events', 'radius');

        return view('default/home', $data);
    }
}
