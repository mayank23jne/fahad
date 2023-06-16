<?php

namespace App\Models;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    function question(){
        return $this->hasMany(Question::class);
    }
    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
