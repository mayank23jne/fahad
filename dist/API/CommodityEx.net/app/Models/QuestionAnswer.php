<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];
    function question(){
        return $this->belongsTo(App\Models\Question::class); 
    }

}
