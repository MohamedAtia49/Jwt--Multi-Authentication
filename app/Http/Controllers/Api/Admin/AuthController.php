<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class AuthController extends Controller
{
    use ResponseJson;

    public function __construct()
    {
        $this->middleware('jwt.admins:admins', ['except' => ['adminLogin']]);
        $this->guard = "admins";
    }
    public function adminLogin (Request $request)
    {
        try{
            $validation = Validator()->make($request->all(),[
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validation->fails()) {
                return $this->responseJson(0, $validation->errors()->first(), $validation->errors());
            }

            $credentials = $request->only('email','password');
            config()->set('jwt.ttl', 1);
            $token = Auth::guard('admins')->attempt($credentials);
            $admin = Auth::guard('admins')->user();
            // $admin->api_token = $token;
            if ($token){
                return $this->responseJson('200','Login Successfully',[
                    'admin' => $admin,
                    'api_token' => $token,
                    'expires_in' => auth($this->guard)->factory()->getTTL() * 60,
                ]);
            }else{
                return $this->responseJson('401', 'بيانات الدخول غير صحيحة');
            }

        }
        catch (\Exception $ex){
            return $this->responseJson($ex->getCode(), $ex->getMessage());
        }
    }

    public function me()
    {
        $admin = auth()->guard('admins')->user();
        return response()->json($admin);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('admins')->refresh());
    }
    public function adminLogout(Request $request){
        $token = $request->bearerToken();
        if($token){
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
                return $this->responseJson('404','Logged out successfully');
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this->responseJson('404','some thing went wrongs');
            }
        }else{
            $this->responseJson('404','some thing went wrongs');
        }
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60,
        ]);
    }
}
