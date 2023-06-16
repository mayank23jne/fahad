<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

route::get('/importExcel',[ExcelController::class,'importExcel']);
route::get('/excel/{id}',[ExcelController::class,'exportExcel']);
route::get('/userReportsAnswer/{category}',[ExcelController::class,'userReportsAnswers']);
route::get('/exportUserReportsAnswer/{category}',[ExcelController::class,'exportUserReportsAnswer']);
// route::get('/excelSecurity',[ExcelController::class,'expoertExcelSecurity']);
