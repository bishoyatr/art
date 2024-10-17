<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    // Define the created_by and updated_by attributes
    protected $created_by;
    protected $updated_by;

    // Automatically set the created_by and updated_by attributes
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }
}
