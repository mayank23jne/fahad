<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredPropertyController;

route::post('/showRegisteredProperty',[RegisteredPropertyController::class,'showRegisteredProperty']);
route::post('/createRegisteredProperty',[RegisteredPropertyController::class,'store']);
route::post('/showRegisteredPropertyId',[RegisteredPropertyController::class,'showRegisteredPropertyId']);
route::post('/showRegisteredFieldbyProperty',[RegisteredPropertyController::class,'showRegisteredFieldbyProperty']);
route::post('/updateRegisteredProperty',[RegisteredPropertyController::class,'update']);
route::delete('/deleteRegisteredProperty/{id}',[RegisteredPropertyController::class,'destroy']);
route::post('/statusRegisteredProperty',[RegisteredPropertyController::class,'changeStatus']);
route::post('/isDeletedRegisteredProperty',[RegisteredPropertyController::class,'isDelete']);
route::post('/archiveRegisteredProperty',[RegisteredPropertyController::class,'archiveRegisteredProperty']);
route::post('/showRegisteredFieldId',[RegisteredPropertyController::class,'showRegisteredFieldId']);
route::post('/showRegisteredFieldbyId',[RegisteredPropertyController::class,'showRegisteredFieldbyId']);
route::get('/showRegisteredFields',[RegisteredPropertyController::class,'showRegisteredFields']);

route::post('/showRegisteredPropertyunitid',[RegisteredPropertyController::class,'showRegisteredPropertyunitid']);
route::post('/showOfficeByid',[RegisteredPropertyController::class,'showOfficeByid']);


