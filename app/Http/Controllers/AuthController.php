<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthenticateRequest;

use \JWTAuth as JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Hash;
use Validator;
use App\Usuario;

class AuthController extends Controller
{
    // private $auth;

    // public function __construct(JWTAuth $auth) {
    //     $this->auth = $auth;
    // }

    public function authenticate(Request $request) {
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'password' => 'required',
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Credentials',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $usuario = Usuario::where(['email'=> $credentials['email']])->first();

        if(!$usuario) {
            return response()->json([
                // 'message' => 'Invalid Credentials'
                'message' => 'Usuário não existe'
            ], 401);
        }

        $credentials['senha'] = $credentials['password'];
        unset($credentials['password']);

        // if(!Hash::check($credentials['password'], $usuario->senha)) {
        //     return response()->json([
        //         // 'message' => 'Invalid Credentials'
        //         'message' => 'Senha Incorreta'
        //     ], 401);
        // }

        try {
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Usuário não encontrado'], 401);
            }
        } catch(JWTException $e) {
            return response()->json(['message' => 'Não foi possível realizar a autenticação']);
        }

        return response()->json(compact('token'));

        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => $this->auth->decode($token)->get('exp')
        // ]);
    }
}
