<?php

namespace App\Services;

use App\Models\Event;

class AddressGeneratorService
{
    protected $data = [];

    protected $fields = [
        'address',
        'address_2',
        'city',
        'state_id',
        'postal_code'
    ];

    public function __construct(array $data)
    {
        $this->data = array_only($data, $this->fields);
    }

    public function get($glue = '\n')
    {
        if ( ! empty($this->data)) {
            return (new Event())->fill($this->data)->address($glue);
        }

        return null;
    }
}