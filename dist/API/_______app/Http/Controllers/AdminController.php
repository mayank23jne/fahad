<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\UsersPermission;
use App\Models\Permission;
use Validator;
use App\Http\Resources\AdminResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Login credentials are invalid.',
            ], 400);
        }
        return $this->createNewToken($token);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:admins',
            'mobile' => 'required|string|min:9|max:15',
            'password' => 'required|string|min:8',
            'is_active' => 'required|max:1',
            'role_id' => 'required|min:1',
            'nationality' => 'required|max:50',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $admin = Admin::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'sorry data is invalid'], 401);
        }
        return $this->createNewToken($token);
        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $admin
        // ], 201);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        $permissionId = UsersPermission::where('user_id',auth()->user()->id)->get();
        $code =  array();
        array_push($code,"0");
        foreach($permissionId as $permission){
            $data = Permission::find($permission->permission_id)->code;
            array_push($code,$data);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'permissions'=>$code
        ]);
    }
    
    function updatePassword(Request $request){
        $user = Admin::where('id',$request->id)->first();
        $user->update([
        'password' => bcrypt($request->newpassword)
        ]);

        return response()->json("updated password");
        }
}
