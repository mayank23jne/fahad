<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyTypeController;

route::post('/showPropertyType',[PropertyTypeController::class,'shoWPropertyTypes']);
route::post('/createPropertyType',[PropertyTypeController::class,'store']);
route::post('/showPropertyTypeId',[PropertyTypeController::class,'showPropertyTypeId']);
route::post('/updatePropertyType',[PropertyTypeController::class,'update']);
route::delete('/deletePropertyType/{id}',[PropertyTypeController::class,'destroy']);
route::post('/statusPropertyType',[PropertyTypeController::class,'changeStatus']);
route::post('/isDeletedPropertyType',[PropertyTypeController::class,'isDelete']);
route::post('/archivePropertyTypes',[PropertyTypeController::class,'archivePropertyTypes']);