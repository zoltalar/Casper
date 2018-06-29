<?php

namespace App\Models;

class State extends Base
{
    public $timestamps = false;

    protected $table = 'states';

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Generate states list for <select> element.
     *
     * @return  array
     */
    public static function states()
    {
        $states = [];

        $models = static::with('country')
            ->orderBy('name', 'asc')
            ->get();

        foreach ($models as $model) {
            $states[$model->country->name][$model->id] = $model->name;
        }

        ksort($states, SORT_STRING);

        return $states;
    }
}