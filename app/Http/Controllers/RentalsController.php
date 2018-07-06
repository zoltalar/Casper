<?php

namespace App\Http\Controllers;

use App\Models\Car;

class RentalsController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return view('rentals.index', compact('cars'));
    }
}