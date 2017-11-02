<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('events/create');
    }

    public function store()
    {
        $rules = Event::rules();
        $data = request()->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            echo 'test';
        }
    }
}