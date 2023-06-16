<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifcation extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id','reciver_id','read_at'];
}
