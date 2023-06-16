<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::controller(ReportController::class)->group(function(){
    route::get('/reportshr','gethrReports');
    route::get('/reportswh','getwhReports');
    route::get('/reportsUser','userReports');
    route::get('/reportsUserWheres','userReportsWheres');
    route::get('/reportsUserHr','userReportsHr');
    route::get('/hrReport','hrReport');
    route::get('/answerCount','answerCount');
    route::get('/formsReport','forms');
    route::get('/formReportHr','formHr');
    route::get('/formReportWheres','formWheres');
    route::get('/formReportWheresCount','formWhereAnswerCount');
    route::get('/formHrAnswerCount','formHrAnswerCount');
});
