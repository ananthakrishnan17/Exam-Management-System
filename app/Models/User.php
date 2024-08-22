<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','first_name', 'last_name', 'gender', 'dob', 'marital_status', 'email', 'year_of_graduation',  'contact_number', 'address', 'cgpa', 'degree_id', 'updated_by'];
    protected $table = 't_employee_details';
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


    public function createdBy()
        {
            return $this->belongsTo(User::class, 'created_by');
        }

        public function updatedBy()
        {
            return $this->belongsTo(User::class, 'updated_by');
        }


}
