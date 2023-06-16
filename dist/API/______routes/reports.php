<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

route::get('/showDashboard',[DashboardController::class,'showDashboard']);
route::get('/reports',[DashboardController::class,'getReports']);
route::get('/reportsUser',[DashboardController::class,'userReports']);
route::get('/hrReport',[DashboardController::class,'hrReport']);
route::get('/unitChart',[DashboardController::class,'unitChart']);
route::get('/companyChart',[DashboardController::class,'CompanyChart']);
route::get('/companyWheres',[DashboardController::class,'CompanyWheres']);
route::get('/companyDevelopment',[DashboardController::class,'CompanyDevelopment']);
route::get('/answerCount',[DashboardController::class,'answerCount']);
route::get('/formsReport',[DashboardController::class,'forms']);
route::get('/nationalityChart',[DashboardController::class,'nationality']);
route::get('/WorkersChart',[DashboardController::class,'WorkersChart']);
