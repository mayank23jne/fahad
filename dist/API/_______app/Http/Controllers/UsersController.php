<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Resources\ClientResource;

class UsersController extends Controller
{
    function showUsers(){
        $clients = admin::where('role_id','!=',3)->get();
        return new ClientResource($clients);
    }
    function showAllUsers(){
        $users = Admin::latest()->paginate();
        $_data=[];
        $_data["data"] = array();
        foreach($users as $user){
            $data['id'] = $user->id;
            $data['firstname'] = $user->firstname;
            $data['lastname'] = $user->lastname;
            $data['email'] = $user->email;
            $data['mobile'] = $user->mobile;
            $data['is_active'] = $user->is_active;
            $data['role_id'] = $user->role_id;
            $user['nationality'] = $user->nationality;
            $data['created_at'] = $user->created_at;
            $data['updated_at'] = $user->updated_at;
            array_push($_data["data"],$data);
        }
        // return $user['type_id'];
        return response()->json($_data);
    }
    function showUser($id){
        $user = Admin::find($id);
        $_data=[];
        $_data["data"] = array();
        $data['id'] = $user->id;
        $data['firstname'] = $user->firstname;
        $data['lastname'] = $user->lastname;
        $data['email'] = $user->email;
        $data['mobile'] = $user->mobile;
        $data['is_active'] = $user->is_active;
        $data['role_id'] = $user->role_id;
        $user['nationality'] = $user->nationality;
        $data['created_at'] = $user->created_at;
        $data['updated_at'] = $user->updated_at;
        array_push($_data["data"],$data);

        return response()->json($_data);
    }
    
    function updatePassword(Request $request){
        $user = Admin::find($request->id);
        $user->update([
        'password' => bcrypt($request->newpassword)
        ]);

        return response()->json("updated password");
    }
}
