<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

route::get('/showDashboard',[DashboardController::class,'showDashboard']);
