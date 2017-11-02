<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{
    /**
     * Constraints prohibiting the object from being deleted.
     *
     * @var array
     */
    protected $deleteConstraints = [];

    /**
     * Override
     *
     * @param   bool $constraintCheck check if object can be deleted
     * @return  bool|null
     * @throws  \Exception
     */
    public function delete($constraintCheck = false)
    {
        if ($constraintCheck && $this->exists) {
            foreach ($this->deleteConstraints as $constraint) {
                if ($this->{$constraint}->count() > 0) {
                    return false;
                }
            }
        }

        return parent::delete();
    }
}