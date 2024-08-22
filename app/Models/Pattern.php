<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todolist;
class Pattern extends Model
{
    use HasFactory;
    protected $table= 't_question_pattern';
    protected $fillable = ['question_pattern_id','use_notuse'];
    public $timestamps = false;
    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->created_date = now()->format('Y-m-d H:i:s');
        $model->updated_date = now()->format('Y-m-d H:i:s');
    });

    static::updating(function ($model) {
        $model->updated_date = now()->format('Y-m-d H:i:s');
    });
}

public function employeeDetails()
{
    return $this->hasOne(User::class, 'user_id', 'user_id');
}

public function questionOptions()
{
    return $this->hasMany(Question::class, 'question_pattern_id', 'answer');
}
public function aptitudeQuestionsWithOptions()
{
    return $this->hasMany(Exam::class, 'question_id', 'answer');
}
}
