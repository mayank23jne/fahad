<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }



    function answer(){
        return $this->hasMany(Answer::class,'user_id');
    }
    function task(){
        return $this->hasMany(Task::class);
    }

    function unit(){
        return $this->hasMany(Unit::class);
    }
    function company(){
        return $this->hasMany(Company::class);
    }
    function template(){
        return $this->hasMany(Template::class);
    }
    function category(){
        $this->belongsTo(UsersCategory::class);
    }
}
