<?php

namespace App\Transformers;

class CsvRowTransformer extends Base
{
    protected $headers = [];

    public function transformItem($item)
    {
        $transformedItem = [];



        return $transformedItem;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }
}