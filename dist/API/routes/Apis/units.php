<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AnswerController;


route::get('/showUnits',[UnitController::class,'showUnits']);
route::get('/showUnit/{id}',[UnitController::class,'showUnit']);
route::get('/ShowUnitDetail/{id}',[UnitController::class,'ShowUnitDetail']);
//route::get('/showClients',[ClientController::class,'showClients']);

route::get('/showClients/{id}',[ClientController::class,'showClients']);
route::post('/createUnit',[UnitController::class,'store']);
route::get('/units_status',[AnswerController::class,'AnswersPerUnit']);
