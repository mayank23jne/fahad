<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    function showRoles(){
        $roles = Role::orderBy('id', 'DESC')->get();
        // $roles = Role::all();
        return response()->json($roles);
    }
    function store(Request $request){
        $role = new Role;
        $role->role_name = $request->role_name;
        $role->save();
        return response()->json($role,200);
    }
}
