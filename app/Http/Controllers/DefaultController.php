<?php

namespace App\Http\Controllers;

use App\Models\Event;

class DefaultController extends Controller
{
    public function home()
    {
        $events = Event::query()
            ->where('date', '>=', date('Y-m-d'))
            ->when(!$this->coordinates->empty(), function($query) {
                $query->haversine($this->coordinates, $this->radius);
            })
            ->when(auth()->guest(), function($query) {
                $query->where('public', 1);
            })
            ->orderBy('date', 'asc')
            ->simplePaginate(4);

        $data = compact('events');

        return view('default/home', $data);
    }
}
