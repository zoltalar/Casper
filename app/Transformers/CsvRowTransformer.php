<?php

namespace App\Transformers;

class CsvRowTransformer extends Base
{
    protected $headers = [];

    public function transformItem($item)
    {
        $transformedItem = [];

        if (count($this->headers) > 0) {
            foreach ($this->headers as $index => $header) {
                $transformedItem[$header] = array_get($item, $index);
            }
        } else {
            $transformedItem = $item;
        }

        return $transformedItem;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }
}