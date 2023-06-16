<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

route::get('/showRoles',[RoleController::class,'showRoles']);
route::post('/addRole',[RoleController::class,'store']);
