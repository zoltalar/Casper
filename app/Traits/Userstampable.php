<?php

namespace App\Traits;

use App\Models\User;

trait Userstampable
{
    /**
     * Boot userstampable trait for a model.
     *
     * @return  void
     */
    public static function bootUserstampable()
    {
        // Register model events to listen to
        static::creating(function($model) {
            if ($model->created_by === null) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function($model) {
            if ($model->updated_by === null) {
                $model->updated_by = auth()->id();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}