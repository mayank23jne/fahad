<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Template;
use App\Models\QuestionType;
use App\Models\QuestionAnswer;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];
    function template(){
        return $this->belongsTo(Template::class); 
    }

    function type(){
        return $this->belongsTo(QuestionType::class); 
    }

    function answer(){
        return $this->hasMany(QuestionAnswer::class);
    }

}

