<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'Created_By',
        'Modified_By',
        'Deleted_By',
        'Nav_Synced',
        'Web_Synced',
        'Delete_Synced',
        'Last_Synced_Timestamp',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Audit info for models extending base model
     * to capture created_by, updated_by and deleted_by fields
     */
    public static function boot()
    {
        static::created(function ($model){
            if ($model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'Created_By')){
                $model->Created_By = Auth()->id() ?: '0';
                $model->save();
            }
        });

        static::updated(function ($model){
            if ($model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'Modified_By')) {

                if (Auth()->check())
                    if (Auth()->id() !== $model->Modified_By){
                        $model->Modified_By = Auth()->id();
                        $model->Nav_Synced = false;
                        $model->save();
                    }
            }
        });

        static::deleted(function ($model){
            if ($model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'Deleted_By')) {
                $model->Deleted_By = Auth()->id() ?: '0';
                $model->Delete_Synced = true;
                $model->save();
            }
        });

        parent::boot();
    }


}