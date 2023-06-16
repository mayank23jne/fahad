<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitTypeController;

route::get('/showUnitTypes',[UnitTypeController::class,'shoWUnitsTypes']);
route::post('/addUnitType',[UnitTypeController::class,'store']);
