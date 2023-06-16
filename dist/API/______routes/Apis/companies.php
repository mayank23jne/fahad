<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


route::get('/showCompanies',[CompanyController::class,'showCompanies']);
route::post('/addCompany',[CompanyController::class,'store']);
