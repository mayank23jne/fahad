<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

route::get('/importExcel',[ExcelController::class,'importExcel']);
