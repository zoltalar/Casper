<?php

namespace App\Traits;

trait Namable
{
    /**
     * Person's full name
     *
     * @param bool $standard
     * @return string
     */
    public function fullName($standard = true)
    {
        $name = '';

        if ($standard) {
            if ( ! empty($this->first_name)) {
                $name .= $this->first_name;
                $name .= ' ';
            }

            $name .= $this->last_name;
        } else {
            $name .= $this->last_name;

            if ( ! empty($this->first_name)) {
                $name .= ', ';
                $name .= $this->first_name;
            }
        }

        return $name;
    }
}