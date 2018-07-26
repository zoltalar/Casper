<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalRequest;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;

class RentalsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth')->except(['index']);
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

        $rental = new Rental();
        $rental->from = (new Carbon())->startOfDay()->toDateTimeString();
        $rental->to = (new Carbon())->endOfDay()->toDateTimeString();

        return view('rentals.rent', compact('car', 'rental'));
    }

    public function rentalDates(Car $car)
    {
        return response()->json($car->rentalDates());
    }

    public function store(RentalRequest $request)
    {
        $rental = new Rental();

        $data = $request->only($rental->getUnguarded());
        $data['user_id'] = decrypt($data['user_id']);
        $data['car_id'] = decrypt($data['car_id']);

        $rental->fill($data);
        $rental->save();

        session()->flash('message', 'You have successfully rented a car.');

        return redirect()->route('rentals.index');
    }
}