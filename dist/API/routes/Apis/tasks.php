<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Mobile\TaskMobileController;

Route::controller(TaskController::class)->group(function(){

    route::get('/showTaskInfo/{id}','showInfo');
    route::get('/showTask/{id}','showTask');
    route::post('/updateTask','update');
    route::get('/taskHrCompleted','completed_Hr'); // تقرير المهام المكتملة للموارد البشرية
    route::get('/taskemCompleted','completed_em');// تقرير المهام المكتملة للطوارئ
    route::get('/taskHrPending','pending_Hr'); // تقرير المهام المعلقة للموارد البشرية
    route::get('/taskemPending','pending_em');// تقرير المهام المعلقة للطوارئ
    route::get('/taskHrnotDone','notDone_Hr'); // تقرير المهام المرفوضة للموارد البشرية
    route::get('/taskemNotDone','notDone_em');// تقرير المهام المرفوضة للطوارئ
    route::get('/taskPending','pending');
    route::get('/taskNotdone','notdone');
});
// mobile
Route::controller(TaskMobileController::class)->group(function(){

    route::post('/mobile/updateTask','update');

});