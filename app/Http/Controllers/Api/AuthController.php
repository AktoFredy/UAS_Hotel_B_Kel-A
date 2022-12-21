<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\teleponVad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request){
        $registrationData = $request->all();

        $validator = Validator::make($registrationData, [
            'username' => 'required|unique:users|alpha_num',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required',
            'nama' => 'required|string|max:60',
            'umur' => 'required|numeric',
            'gender' => 'required',
            'alamat' => 'required',
            'no_hp' => [new teleponVad],
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $registrationData['password'] = bcrypt($request->password);

        $user = User::create($registrationData);

        // $tokenRegis = $user->createToken('authToken')->accessToken;

        return  response([
            'message' => 'Register Success',
            // 'access_token' => $tokenRegis,
            'user' => $user
        ], 200);
    }

    public function login(Request $request){
        $loginData = $request->all();

        // return response(['message' => $loginData], 200);
        $validator = Validator::make($loginData,[
            'email' => 'required|',
            'password' => 'required'
        ]);

       

        if($validator->fails()){
            return response(['message' => $validator->errors()], 422);
        }

        if(!Auth::attempt($loginData)){
            return response(['message' => 'Invalid Credentials'], 400);
        }

        $user = Auth::user();
        // $tokenLogin = $user->createToken('authToken')->accessToken;

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            // 'token_type' => 'Bearer',
            // 'access_token' => $tokenLogin
        ]);        
    }

    public function logout(Request $request){
        if(Auth::user()){
            $user = Auth::user()->token();
            $user->revoke();

            return response([
                'message' => 'Logout Successfully', 
                'success' => true,
                'data_user' => Auth::user() // mereturnkan data user yang logout
            ]);
        }else{
            return response([
                'success' => false,
                'message' => 'Unable To Logout'
            ]);
        }
    }
}
