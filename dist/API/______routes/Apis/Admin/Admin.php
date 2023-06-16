<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('api')->prefix('admin')->group(function(){
Route::post('/login', [AdminController::class, 'login'])->middleware('throttle:users');
Route::post('/create', [AdminController::class, 'register'])->middleware('throttle:users');
Route::post('/resetpassword', [AdminController::class, 'updatePassword'])->middleware('throttle:users');
Route::post('/logout', [AdminController::class, 'logout']);
Route::post('/refresh', [AdminController::class, 'refresh']);
Route::get('/user-profile', [AdminController::class, 'userProfile']);
}); 
