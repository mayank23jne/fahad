<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\UsersPermission;

class PermissionController extends Controller
{
    function showPermissions(){
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    function addUserPermission(Request $request){
        $userPermission = UsersPermission::where('user_id',$request->user_id)->delete();
        foreach ($request['permissions'] as $perm) {
            $userPermission= new UsersPermission();
            $userPermission->user_id =  $request->user_id;
            $userPermission->permission_id =  $perm;
            $userPermission->save();
        }
        return response()->json('user permission has been created');
    }
}
