<?php

namespace App\Models;

use App\Contracts\Address;
use App\Contracts\Coordinates;
use App\Contracts\Userstamp;
use App\Traits\Addressable;
use App\Traits\Coordinable;
use App\Traits\Userstampable;

class Event extends Base implements Address, Coordinates, Userstamp
{
    use Addressable, Coordinable, Userstampable;

    protected $table = 'events';

    protected $guarded = ['id'];

    public function users()
    {
        return $this
            ->belongsToMany('App\Models\User', 'events_users')
            ->withPivot(['invited', 'approved']);
    }

    /**
     * Retrieve user information for an event.
     *
     * @param   int $id user id
     * @return  \App\Models\User|null
     */
    public function user($id = null)
    {
        if ($id === null) {
            $id = auth()->id();
        }

        return $this
            ->users()
            ->get()
            ->filter(function($user) use ($id) {
                return $user->id == $id;
            })
            ->first();
    }

    /**
     * Event meta information.
     *
     * @return  string
     */
    public function meta()
    {
        $meta = [$this->date];

        if ( (int) $this->all_day != 1) {
            $meta[] = 'at';
            $meta[] = $this->time;
        }

        return implode(' ', $meta);
    }

    public static function rules(array $keys = null)
    {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state_id' => 'required',
            'postal_code' => 'required|digits:5',
            'max_attendees' => 'nullable|numeric'
        ];

        if ( ! empty($keys)) {
            return array_only($rules, $keys);
        }

        return $rules;
    }

    public static function radii()
    {
        return [
            '5' => '5 miles',
            '10' => '10 miles',
            '20' => '20 miles',
            '50' => '50 miles'
        ];
    }
}