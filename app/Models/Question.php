<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't_question';
    protected $fillable = [
        'question_pattern_id',
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
    ];
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
public function aptitudeQuestion()
{
    return $this->belongsTo(Exam::class, 'question_pattern_id', 'question_id');
} 
}
