<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;


route::post('/addUserPermission',[PermissionController::class,'addUserPermission']);
route::get('/showPermissions',[PermissionController::class,'showPermissions']);
