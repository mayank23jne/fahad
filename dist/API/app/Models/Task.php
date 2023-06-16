<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    function answerDetails(){
        return $this->belongsTo(AnswerDetail::class);
    }
    function status(){
        return $this->belongsTo(Status::class);
    }
    
    function user(){
        return $this->belongsTo(Admin::class);
    }
}
