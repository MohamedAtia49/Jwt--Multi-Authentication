<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ResponseJson;
    public function __construct()
    {
        $this->middleware('jwt.users:users', ['except' => ['userLogin']]);
        $this->guard = "users";

    }
    public function userLogin (Request $request)
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
            $token = Auth::guard('users')->attempt($credentials);
            $user = Auth::guard('users')->user();
            // $user->api_token = $token;
            if ($token){
                return $this->responseJson('200','Login Successfully',[
                    'admin' => $user,
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
        return response()->json(auth()->guard('users')->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('users')->refresh());
    }
    public function userLogout(Request $request){
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
