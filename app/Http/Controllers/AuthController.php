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
            ], 401)->header('Access-Control-Allow-Origin', '*');
        }

        if(!Hash::check($credentials['password'], $usuario->senha)) {
            return response()->json([
                // 'message' => 'Invalid Credentials'
                'message' => 'Senha Incorreta'
            ], 401)->header('Access-Control-Allow-Origin', '*');
        }

        $token = JWTAuth::fromUser($usuario);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ])->header('Access-Control-Allow-Origin', '*');
    }

    // somewhere in your controller
    public function getAuthenticatedUser(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $token = JWTAuth::getToken();
            $new_token = JWTAuth::refresh($token);
            JWTAuth::setToken($new_token);
            // return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}
