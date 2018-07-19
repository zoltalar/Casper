<?php

namespace App\Http\Controllers;

use App\Models\Car;

class RentalsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this
            ->middleware('auth')
            ->except(['index']);
    }

    public function index()
    {
        $cars = Car::all();

        return view('rentals.index', compact('cars'));
    }

    public function rent($id)
    {
        $car = Car::find(decrypt($id));

        if ($car === null) {
            return redirect()->route('rentals.index');
        }

        return view('rentals.rent', compact('car'));
    }
}