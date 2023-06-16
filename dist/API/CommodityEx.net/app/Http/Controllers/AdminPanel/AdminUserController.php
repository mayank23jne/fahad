<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
class AdminUserController extends Controller
{
    function getUsers(){
        return response()->json([
            'users' => AdminUser::all(),
        ]);
    }
}
