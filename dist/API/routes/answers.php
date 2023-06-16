<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;

route::post('/addAnswer',[AnswerController::class,'store']);
route::get('/showAnswer/{id}',[AnswerController::class,'showAnswer']);
route::get('/showAnswerHr',[AnswerController::class,'showAnswerHrForm']);
route::get('/showAnswerWhere',[AnswerController::class,'showAnswerWhereForm']);
route::get('/companyForms/{id}',[AnswerController::class,'AnswersPerUnitForCompany']);
route::get('/form_status/{id}',[AnswerController::class,'AnswersPerTemplate']);
route::get('/form_status_answers/{id}',[AnswerController::class,'AnswersPerTemplateAnswers']);
route::get('/showAnswerDetail/{id}',[AnswerController::class,'showAnswerDetail']);
route::post('/SaveMobileAnswer','SaveMobileAnswer');
