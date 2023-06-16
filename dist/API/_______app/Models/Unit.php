<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guareded = [];


    function answer(){
        return $this->hasMany(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(Admin::class,"client_id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class,"company");
    }
    public function company_()
    {
        return $this->belongsTo(Company::class,"company");
    }
    function unitType(){
        return $this->belongsTo(UnitType::class,'unitType_id');
    }
}
