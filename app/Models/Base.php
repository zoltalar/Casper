<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

abstract class Base extends Model
{
    const DEFAULT_STRING_LENGTH = 191;

    /**
     * Constraints prohibiting the object from being deleted.
     *
     * @var array
     */
    protected $deleteConstraints = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            if (Schema::hasColumn($model->getTable(), 'created_by')) {
                if ($model->created_by === null) {
                    $model->created_by = auth()->user()->id;
                }
            }
        });

        static::updating(function($model) {
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                if ($model->updated_by === null) {
                    $model->updated_by = auth()->user()->id;
                }
            }
        });
    }

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