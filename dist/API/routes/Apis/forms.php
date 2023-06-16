<?php

use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

route::get('/formInfo/{id}',[TemplateController::class,'formDetails']);
