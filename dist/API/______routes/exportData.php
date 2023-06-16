<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;


// route::get('/exportPdf',[PdfController::class,'exportJsonPdf']);
route::get('/print/{id}',[PrintController::class,'show']);
// route::get('/print',function(){
//     return view('pdf');
// });
