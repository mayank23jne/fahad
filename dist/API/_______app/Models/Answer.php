<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];
    function question(){
        return $this->belongsTo(Question::class);
    }
    function user(){
        return $this->belongsTo(Admin::class);
    }
    function units(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
    function template(){
        return $this->belongsTo(Template::class);
    }
    function ansDetail(){
        return $this->hasMany(AnswerDetail::class);
    }
}
