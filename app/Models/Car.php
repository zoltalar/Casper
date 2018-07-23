<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

final class Car extends Base
{
    public $timestamps = false;

    protected $table = 'cars';

    protected $guarded = ['id'];

    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * List dates when a car is rented out.
     *
     * @return  array
     */
    public function rentalDates()
    {
        $dates = [];
        $rentals = $this->rentals->all();

        foreach ($rentals as $rental) {
            $periods = (new CarbonPeriod($rental->from, $rental->to))->toArray();
            $_dates = array_map(function(Carbon $date) {
                return $date->toDateString();
            }, $periods);

            $dates = array_merge($dates, $_dates);
        }

        $dates = array_unique($dates, SORT_STRING);

        return $dates;
    }
}