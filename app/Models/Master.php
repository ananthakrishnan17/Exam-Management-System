<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $fillable = ['degree_name','degree_name_s','updated_by'];
    
    protected $table = 'm_degrees';

    public $timestamps = false;   
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_date = now();
            $model->updated_date = now();
        });

        static::updating(function ($model) {
            $model->updated_date = now();
        });
    }


}
