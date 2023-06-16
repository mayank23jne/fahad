<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


route::get('/showCompanies',[CompanyController::class,'showCompanies']);
route::post('/addCompany',[CompanyController::class,'store']);
route::get('/showCompanyId/{id}',[CompanyController::class,'showCompanyId']);
route::post('/updateCompany',[CompanyController::class,'update']);
route::delete('/deleteCompany/{id}',[CompanyController::class,'destroy']);
route::post('/statusCompany',[CompanyController::class,'changeStatus']);
route::post('/isDeletedCompany',[CompanyController::class,'isDelete']);
route::post('/archiveCompany',[CompanyController::class,'archiveCompany']); 