<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api', ['except'=>['login']]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|string|min:8',
        ]);
        if ( $validator->fails()){
            return response()->json($validator->errors(),422);
        }
        if (!$token=auth()->attempt($validator->validated())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // // Mencoba untuk mengotentikasi pengguna
        // try {
        //     if (! $token = JWTAuth::attempt($request->only('email', 'password'))) {
        //         return response()->json(['error' => 'gagal GOBLOK'], 401);
        //     }
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'Could not create token'], 500);
        // }

        // return response()->json(compact('token'));
    }

    public function createNewToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60,
            'user'=>auth()->user()
        ]);
    }

    public function logout()
    {
        // Mengeluarkan token (invalidate)
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function me()
    {
        return response()->json(auth()->user());
    }
}