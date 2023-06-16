<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;


route::post('/create',[QuestionsController::class,'store']);
route::get('/show',[QuestionsController::class,'show']);
route::get('/show/{id}',[QuestionsController::class,'showForm']);
route::post('/update',[QuestionsController::class,'update']);
route::post('/getimage',[QuestionsController::class,'getimage']);
route::post('/updateTemplate',[QuestionsController::class,'updateTemplate']);
route::post('/isDeleteTemplate',[QuestionsController::class,'isDeleteTemplate']);