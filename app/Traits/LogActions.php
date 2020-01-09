<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogActions
{
    protected static function bootLogActions()
    {
        static::created(function ($model)
        {
            if(!\Auth::guest()) {
                $modelName = get_class($model);
                if($modelName != 'App\Log'){
                   // \App\Log::Logger('created a '.str_replace("App\\", "", $modelName), $model->{$model->primaryKey}, $modelName,'',  'created',$model->log_detail);
                }
            }
        });

        static::updated(function ($model)
        {

            if(!\Auth::guest()) {
                $modelName = get_class($model);
                // dd($model);
                if($modelName != 'App\Log') {
                   // \App\Log::Logger('updated a ' . str_replace("App\\", "", $modelName), $model->{$model->primaryKey}, $modelName, '', 'updated', $model->log_detail);
                }
            }
        });

        static::deleted(function ($model)
        {
            if(!\Auth::guest()) {
                $modelName = get_class($model);
                if($modelName != 'App\Log') {
                   // \App\Log::Logger('deleted a ' . str_replace("App\\", "", $modelName), $model->{$model->primaryKey}, $modelName, '', 'deleted',$model->log_detail);
                }
            }
        });
    }
}
