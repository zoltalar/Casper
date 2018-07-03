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

    /**
     * Constructor.
     *
     * @param   array $data
     */
    public function __construct(array $data)
    {
        $this->data = array_only($data, $this->fields);
    }

    /**
     * Get address.
     *
     * @param   string $glue
     * @return  null|string
     */
    public function get($glue = '\n')
    {
        if ( ! empty($this->data)) {
            return (new Event())->fill($this->data)->address($glue);
        }

        return null;
    }
}