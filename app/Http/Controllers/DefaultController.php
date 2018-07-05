<?php

namespace App\Http\Controllers;

class DefaultController extends Controller
{
    public function home()
    {
        return redirect()->route('events.index');
    }
}
