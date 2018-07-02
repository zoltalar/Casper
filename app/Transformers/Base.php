<?php

namespace App\Transformers;

abstract class Base
{
    public function __invoke($item)
    {
        return $this->transformItem($item);
    }

    /**
     * Transform single item.
     *
     * @param   mixed $item
     * @return  mixed
     */
    public abstract function transformItem($item);

    /**
     * Transform all items.
     *
     * @param   array $items
     * @return  array
     */
    public function transformAll($items)
    {
        $transformedItems = [];

        foreach ($items as $item) {
            $transformedItems[] = $this->transformItem($item);
        }

        return $transformedItems;
    }
}