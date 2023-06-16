<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotifcationController;


route::get('/all_notifcation',[NotifcationController::class,'all_notifcation']);
route::get('/read_all_notifcations',[NotifcationController::class,'read_all_notifcations']);
