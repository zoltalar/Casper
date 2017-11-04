<?php

namespace App\Contracts;

interface Userstamp
{
    /**
     * Get user that created the model.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function creator();

    /**
     * Get user that updated the model.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function editor();
}