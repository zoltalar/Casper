<?php

namespace App\Traits;

trait Userstampable
{
    /**
     * Boot userstampable trait for a model.
     *
     * @return void
     */
    public static function bootUserstampable()
    {
        static::registerEvents();
    }

    /**
     * Register model events to listen to.
     *
     * @return void
     */
    public static function registerEvents()
    {
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
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}