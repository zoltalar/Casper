<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class DefaultController extends Controller
{
    public function home()
    {
        $events = Event::query()
            ->where('date', '>=', (new Carbon())->toDateString())
            ->when(auth()->guest(), function($query) {
                $query->where('public', 1);
            })
            ->orderBy('date', 'asc')
            ->simplePaginate(4);

        $data = compact('events');

        return view('default/home', $data);
    }
}
