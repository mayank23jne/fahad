<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

route::get('/showClients',[ClientController::class,'showUnitClients']);
route::get('/showClientsData',[ClientController::class,'showClientsData']);
route::post('/createClient',[ClientController::class,'store']);
route::get('/showAllClientsData',[ClientController::class,'showAllClientsData']);
route::post('/isDeleteClient',[ClientController::class,'isDeleteClients']);
route::post('/changeStatus',[ClientController::class,'changeStatus']);
route::post('/changePassword',[ClientController::class,'changePassword']);