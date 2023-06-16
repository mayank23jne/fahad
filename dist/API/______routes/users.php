<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;


route::get('/showUsers',[UsersController::class,'showUsers']);
route::get('/showAllUsers',[UsersController::class,'showAllUsers']);
route::get('/showUser/{id}',[UsersController::class,'showUser']);
route::post('/innovative_20',[UsersController::class,'updatePassword']);
