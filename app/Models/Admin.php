<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{

    public $timestamps = false; 

    protected $table = 't_admin_details';
    protected $fillable = [
        'admin_id',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'address',
        'marital_status',
        'contact_number', 
        'email',
        'use_notuse',
        'updated_by'
   ];
   protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->created_date = now();
            $user->updated_date = now();
        });

        static::updating(function ($user) {
            $user->updated_date = now();
        });
    }
}
