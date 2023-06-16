<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::controller(ChartController::class)->group(function(){
    route::get('/unitChart','unitChart');
    route::get('/companyChart','CompanyChart');
    route::get('/companyWheres','CompanyWheres');
    route::get('/companyDevelopment','CompanyDevelopment');
    route::get('/nationalityChart','nationality');
    route::get('/WorkersChart','WorkersChart');
    route::get('/totalHrTemplates','totalHrTemplates');
    route::get('/saveCompanyChartInDB','saveCompanyChartInDB');
    route::get('/totalemTemplates','totalemTemplates');
});
