<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

route::get('/importExcel',[ExcelController::class,'importExcel']);
route::get('/userReportsAnswer/{id}',[ExcelController::class,'expoertExcel']);
route::get('/userReportsAnswer/{category}',[ExcelController::class,'userReportsAnswers']);
// route::get('/excelSecurity',[ExcelController::class,'expoertExcelSecurity']);
