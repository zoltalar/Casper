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

        $address = Event::generateAddress($data, $rules, ',');
        $coordinates = Event::resolveAddress($address);

        $latitude = $coordinates->latitude();
        $longitude = $coordinates->longitude();

        if ($latitude !== null) {
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

        return view('default/home', compact('address', 'events'));
    }
}
