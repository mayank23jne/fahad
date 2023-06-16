<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersCategoryController;
Route::controller(UsersCategoryController::class)->prefix('/category')->group(function(){

    route::get('/','show');
    route::post('/create','store');
    route::post('/update/{id}','update');
    route::delete('/delete/{id}','destroy');
    route::post('/showbyId','showbyId');
    route::post('/changeStatus','changeStatus');
route::post('/isDelete','isDelete');
route::post('/archive','archive');

});
