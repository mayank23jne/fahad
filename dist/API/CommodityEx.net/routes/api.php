<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

route::post('/create',[QuestionsController::class,'store']);
route::get('/show',[QuestionsController::class,'show']);
route::get('/show/{id}',[QuestionsController::class,'showForm']);
route::put('/update',[QuestionsController::class,'update']);

route::post('/addAnswer',[AnswersController::class,'store']);
route::get('/test',function (){
    return "test";
});

// route::middleware('jwt-auth')->group(function(){
//     route::post('/create',[QuestionsController::class,'store']);
//     route::get('/show',[QuestionsController::class,'show']);
//     route::get('/show/{id}',[QuestionsController::class,'showForm']);

// });


############################## Admin ###################################

require "Admin/Admin.php";
