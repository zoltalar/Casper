<?php

namespace App\Contracts;

interface Name
{
    /**
     * Person's full name.
     *
     * @param bool $standard
     * @return mixed
     */
    public function fullName($standard = true);
}