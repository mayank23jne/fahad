<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\UsersPermission;
use App\Models\Permission;
use App\Models\Role;
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
       // print_r($request->email_or_phone);
        $email = "";
        // if($request->email_or_phone){
        //     $email = $request->email_or_phone;
        // }else{
            $email = $request->email;
        // }
        //$credentials = $request->only('email', 'password');
    	$validator = Validator::make($request->all(), [
            // 'email_or_phone' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
         try {

            $login_type = filter_var( $email, FILTER_VALIDATE_EMAIL ) ? 'email' : 'mobile';

            // return $login_type;

            $credentials = [$login_type => $email, 'password'=>$request->password];

            if (! $token = Auth::attempt($credentials)) {
                return response()->json([
                'success' => false,
                'message' => 'Login credentials are invalid.',
            ], 400);
            }

           return $this->createNewToken($token);
        } catch(JWTException $e) {
           return response()->json([
                'success' => false,
                'message' => 'An error occured, please contact support.',
            ], 500);
            // return response()->json($this->customResponse("failed", "An error occured, please contact support.", $user), 500);

        }
        
        // if (! $token = JWTAuth::attempt($credentials)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Login credentials are invalid.',
        //     ], 400);
        // }
        // return $this->createNewToken($token);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|between:2,100',
            'email' => 'nullable|unique:admins',
            'mobile' => 'required|string|min:9|max:15|unique:admins',
            'password' => 'required|string|min:6',
            'is_active' => 'required|max:1',
            'role_id' => 'required|min:1',
            'category_id'=>'nullable|min:1',
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
        $role = Role::where('id',auth()->user()->role_id)->get();
        $code =  array();
        array_push($code,"0");
       
       
        foreach($permissionId as $permission){
            $data = Permission::find($permission->permission_id)->code;
            array_push($code,$data);
        }
        if(!in_array('10', $code))
        {
          //echo "not exist";
         array_push($code,"10");
        
        }
         
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'permissions'=>$code,
            'role'=>$role[0]
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
