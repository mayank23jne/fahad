<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
foreach (glob(__DIR__."/Apis/*.php") as $filename)
{
    include $filename;
}

foreach (glob(__DIR__."/Apis/Admin/*.php") as $filename)
{
    include $filename;
}


Route::get('/getLogs', [AnswerController::class , 'paginate_Answer_per_Unit_2']);


























// // <!-- Questions -->
// require "Apis/questions.php";

// // <!-- Answers -->
// require "Apis/answers.php";

// // <!-- Admin -->
// require "Apis/Admin/Admin.php";

// // <!-- Units -->
// require "Apis/units.php";

// // <!-- Clients -->
// require "Apis/clients.php";

// // <!-- Users -->
// require "Apis/users.php";

// // <!-- Tasks -->
// require "Apis/tasks.php";

// // <!-- Companies -->
// require "Apis/companies.php";

// // <!-- Roles -->
// require "Apis/roles.php";

// // <!-- Unit Types -->
// require "Apis/unitsType.php";

// // <!-- Reports -->
// require "Apis/reports.php";

// // <!-- charts -->
// require "Apis/charts.php";

// // <!-- dashboard -->
// require "Apis/dashboard.php";

// // <!-- Permissions -->
// require "Apis/permissions.php";

// // <!-- notifcation -->
// require "Apis/notifcations.php";

// // <!-- Import and Export data -->
// require "Apis/exportData.php";
// require "Apis/excel.php";

