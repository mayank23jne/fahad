<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspectionPropertyController;

route::post('/showInspectionProperty',[InspectionPropertyController::class,'showInspectionProperty']);
route::post('/createInspectionProperty',[InspectionPropertyController::class,'store']);
route::post('/showInspectionPropertyId',[InspectionPropertyController::class,'showInspectionPropertyId']);
route::post('/updateInspectionProperty',[InspectionPropertyController::class,'update']);
route::delete('/deleteInspectionProperty/{id}',[InspectionPropertyController::class,'destroy']);
route::post('/statusInspectionProperty',[InspectionPropertyController::class,'changeStatus']);
route::post('/isDeletedInspectionProperty',[InspectionPropertyController::class,'isDelete']);
route::post('/archiveInspectionProperty',[InspectionPropertyController::class,'archiveInspectionProperty']);