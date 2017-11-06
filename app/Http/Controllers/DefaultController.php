<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class DefaultController extends Controller
{
    public function home()
    {
        $events = Event::where('public', 1)
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->take(10)
            ->simplePaginate(4);

        return view('default/home', compact('events'));
    }
}
