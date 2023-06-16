<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndustryTypeController;

route::get('/showIndustryType',[IndustryTypeController::class,'shoWIndustryTypes']);
route::post('/createIndustryType',[IndustryTypeController::class,'store']);
