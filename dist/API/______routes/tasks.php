<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


route::get('/showTaskInfo/{id}',[TaskController::class,'showInfo']);
route::get('/showTask/{id}',[TaskController::class,'showTask']);
route::post('/updateTask',[TaskController::class,'update']);
route::get('/taskHrCompleted',[TaskController::class,'completed_Hr']); // تقرير المهام المكتملة للموارد البشرية
route::get('/taskemCompleted',[TaskController::class,'completed_em']);// تقرير المهام المكتملة للطوارئ
route::get('/taskHrPending',[TaskController::class,'pending_Hr']); // تقرير المهام المعلقة للموارد البشرية
route::get('/taskemPending',[TaskController::class,'pending_em']);// تقرير المهام المعلقة للطوارئ
route::get('/taskHrnotDone',[TaskController::class,'notDone_Hr']); // تقرير المهام المرفوضة للموارد البشرية
route::get('/taskemNotDone',[TaskController::class,'notDone_em']);// تقرير المهام المرفوضة للطوارئ
route::get('/taskPending',[TaskController::class,'pending']);
route::get('/taskNotdone',[TaskController::class,'notdone']);
