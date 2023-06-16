<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    function question(){
        return $this->belongsTo(Question::class);
    }
    function task(){
        return $this->hasMany(Task::class);
    }
    function answer(){
        return $this->belongsTo(Answer::class);
    }
    
}
