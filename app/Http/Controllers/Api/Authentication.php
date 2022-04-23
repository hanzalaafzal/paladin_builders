<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class Authentication extends Controller
{
    public function authenticate(Request $req){
      $data=$req->only('number','password');
      $validator=Validator::make($data,[
        'number' => 'required|exists:users,number',
        'password' => 'required',
      ],[
        'number.required' => 'number is required',
        'password.required' => 'password is required',
        'number.exists' => 'Invalid Number',
      ]);
      if ($validator->fails()) {
          return response()->json(['error' => $validator->messages()], 500);
      }

      try {
          if (! $token = JWTAuth::attempt($data)) {
                return response()->json([
                  'success' => false,
                  'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
        return $credentials;
            return response()->json([
                  'success' => false,
                  'message' => 'Could not create token.',
                ], 500);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);

    }


}
