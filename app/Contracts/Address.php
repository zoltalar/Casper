<?php

namespace App\Contracts;

interface Address
{
    /**
     * Retrieve address information.
     *
     * @param   string $glue
     * @return  string
     */
    public function address($glue);

    /**
     * Get state associated with the address.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function state();
}