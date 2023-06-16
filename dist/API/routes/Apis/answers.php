<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;


Route::controller(AnswerController::class)->group(function(){
    route::post('/addAnswer','store');
    route::get('/showAnswer/{id}','showAnswer');
    route::put('/updateAnswer/{answer_id}','editAnswer');
    route::get('/showDetailedAns/{id}','showDetailedAns');
    route::get('/showAnswerHr','showAnswerHrForm');
    route::get('/units_status/{category}','AnswersPerUnit');
    route::get('/showAnswerWhere','showAnswerWhereForm');
    route::get('/companyForms/{id}','AnswersPerUnitForCompany');
    route::get('/templateForms/{id}','AnswersPerUnitForTemplates');
    route::get('/form_status/{id}','AnswersPerTemplate');
    route::get('/form_status_answers/{id}','AnswersPerTemplateAnswers');
    route::get('/showAnswerDetail/{id}','showAnswerDetail');
    route::post('/SaveMobileAnswer','SaveMobileAnswer');
});
