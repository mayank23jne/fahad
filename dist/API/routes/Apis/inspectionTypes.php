<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspectionTypeController;

route::post('/showInspectionTypes',[InspectionTypeController::class,'shoWInspectionTypes']);
route::post('/createInspectionType',[InspectionTypeController::class,'store']);
route::post('/showInspectionTypeId',[InspectionTypeController::class,'showInspectionTypeId']);
route::post('/updateInspectionType',[InspectionTypeController::class,'update']);
route::delete('/deleteInspectionType/{id}',[InspectionTypeController::class,'destroy']);
route::post('/statusInspectionType',[InspectionTypeController::class,'changeStatus']);
route::post('/isDeletedInspectionType',[InspectionTypeController::class,'isDelete']);
route::post('/archiveInspectionType',[InspectionTypeController::class,'archiveInspectionTypes']);
route::get('/showAllInspectionTypes',[InspectionTypeController::class,'showAllInspectionTypes']);
route::post('/showInspectionTypeById',[InspectionTypeController::class,'showInspectionTypeById']);