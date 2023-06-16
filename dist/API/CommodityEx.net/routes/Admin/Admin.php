<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('api')->prefix('admin')->group(function(){
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/create', [AdminController::class, 'register']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::post('/refresh', [AdminController::class, 'refresh']);
    Route::get('/user-profile', [AdminController::class, 'userProfile']);
});
