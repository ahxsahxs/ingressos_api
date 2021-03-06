<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthenticateRequest;

use JWTAuth;
use Hash;
use Validator;
use App\Company;

class AuthController extends Controller
{
    public function autenticate(AuthenticateRequest $request) {
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'password' => 'required',
            'email' => 'required|email|'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Credentials',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $company = Company::where(['email'=> $credentials['email']])->first();

        if(!$company) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        if(!Hash::check($credentials['password'], $company->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $token = JWTAuth::fromUser($company);

        $objToken = JWTAuth::setToken($token);
        $expiration = JWTAuth::decode($objToken->getToken()->get('exp'));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::decode()->get('exp')
        ]);
    }
}
