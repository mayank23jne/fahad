<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;


Route::controller(AnswerController::class)->group(function(){
    route::post('/addAnswer','store');
    route::get('/showAnswer/{id}','showAnswer');
    route::get('/showDetailedAns/{id}','showDetailedAns');
    route::get('/showAnswerHr','showAnswerHrForm');
    route::get('/units_status','AnswersPerUnit');
    route::get('/showAnswerWhere','showAnswerWhereForm');
    route::get('/companyForms/{id}','AnswersPerUnitForCompany');
    route::get('/form_status/{id}','AnswersPerTemplate');
    route::get('/form_status_answers/{id}','AnswersPerTemplateAnswers');
    route::get('/showAnswerDetail/{id}','showAnswerDetail');
});
