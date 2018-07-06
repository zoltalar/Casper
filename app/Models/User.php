<?php

namespace App\Models;

use App\Constants\Genders;
use App\Contracts\Name;
use App\Traits\Namable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

final class User extends Base implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    Name
{
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        Notifiable,
        Namable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_users');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    /**
     * Genders array.
     *
     * @return  array
     */
    public static function genders()
    {
        return collect(Genders::GENDERS)
            ->mapWithKeys(function($gender) {
                return [$gender => __('phrases.' . $gender)];
            })
            ->toArray();
    }
}
