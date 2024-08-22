<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    
    protected $fillable = ['question_id', 'answer', 'user_id', 'question_pattern_id'];
    public $timestamps = false;
    protected $table = 't_test_answer';
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
    
    //Inside TAptitudeQuestion model
    public function questionOptions()
    {
        return $this->hasMany(Question::class, 'question_pattern_id', 'question_id');
    }

    public function employeeDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function aptitudeQuestion()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
