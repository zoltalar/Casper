<?php

namespace App\Models;

use App\Contracts\Userstamp;
use App\Traits\Userstampable;

final class Rental extends Base implements Userstamp
{
    use Userstampable;

    protected $table = 'rentals';

    protected $guarded = ['id'];
}