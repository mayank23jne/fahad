<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitTypeController;

route::get('/showUnitTypes',[UnitTypeController::class,'shoWUnitsTypes']);
route::post('/addUnitType',[UnitTypeController::class,'store']);
route::post('/showUnitsTypesId',[UnitTypeController::class,'showUnitsTypesId']);
route::post('/updateUnitType',[UnitTypeController::class,'update']);
route::delete('/deleteUnitType/{id}',[UnitTypeController::class,'destroy']);
route::post('/statusUnitType',[UnitTypeController::class,'changeStatus']);
route::post('/isDeletedUnitType',[UnitTypeController::class,'isDelete']);
route::post('/archiveUnitsTypes',[UnitTypeController::class,'archiveUnitsTypes']);
