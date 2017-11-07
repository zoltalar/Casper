<?php

namespace App;

class CsvRowTransformer
{
    /**
     * CSV headers array
     *
     * @var array
     */
    private $headers = [];

    /**
     * Constructor
     *
     * @param   array $headers
     */
    public function __construct(array $headers = null)
    {
        if ($headers !== null) {
            $this->setHeaders($headers);
        }
    }

    /**
     * Set CSV headers
     *
     * @param   array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Convert index based array to associative array
     *
     * @param   array $row
     * @return  array
     */
    public function transform($row)
    {
        $array = [];

        if ( ! empty($this->headers)) {
            foreach ($row as $index => $column) {
                if (isset($this->headers[$index], $row[$index])) {
                    $array[$this->headers[$index]] = $row[$index];
                }
            }
        } else {
            $array = $row;
        }

        return $array;
    }
}