<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndustryTypeController;

route::post('/showIndustryType',[IndustryTypeController::class,'shoWIndustryTypes']);
route::post('/createIndustryType',[IndustryTypeController::class,'store']);
route::post('/showIndustryTypeId',[IndustryTypeController::class,'showIndustryTypeId']);
route::post('/updateIndustryType',[IndustryTypeController::class,'update']);
route::delete('/deleteIndustryType/{id}',[IndustryTypeController::class,'destroy']);
route::post('/statusIndustryType',[IndustryTypeController::class,'changeStatus']);
route::post('/isDeletedIndustryType',[IndustryTypeController::class,'isDelete']);
route::post('/archiveIndustryTypes',[IndustryTypeController::class,'archiveIndustryTypes']);