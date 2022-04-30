<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use DB;

class Authentication extends Controller
{

    private function checkMacAddress($number,$mac){
        $data=DB::table('users')->where('number',$number)->get()->toArray();
        if($data[0]->mac_address==null || empty($data[0]->mac_address)){
          DB::table('users')->where('number',$number)->update([
            'mac_address' => $mac
          ]);
          return true;
        }else{
          //match mac address
          if($data[0]->mac_address==$mac){
            return true;
          }else{
            return false;
          }
        }
    }

    public function authenticate(Request $req){
      $data=$req->only('number','password');
      $validator=Validator::make($req->all(),[
        'number' => 'required|exists:users,number',
        'password' => 'required',
        'mac' => 'required'
      ],[
        'number.required' => 'number is required',
        'password.required' => 'password is required',
        'number.exists' => 'Invalid Number',
        'mac.required' => 'mac address required'
      ]);
      if ($validator->fails()) {
          return response()->json(['error' => $validator->messages()], 500);
      }

      if($this->checkMacAddress($req->number,$req->mac)==false){
        return response()->json([
          'error' => 'Mac address not matched'
        ],500);
      }

      try {
          if (! $token = JWTAuth::attempt($data)) {
                return response()->json([
                  'success' => false,
                  'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {

            return response()->json([
                  'success' => false,
                  'message' => 'Could not create token.',
                ], 500);
        }
        return response()->json([
            'success' => true,
            'data' => auth()->user(),
            'token' => $token,
        ]);

    }

    public function dashboard(){
      $todaySales=DB::table('tickets')->where('fk_saleman',auth()->user()->id)->whereDate('created_at','=',date('Y-m-d'))->sum('quantity');
      $ticketsSold=DB::table('tickets')->where('fk_saleman',auth()->user()->id)->sum('quantity');
      $Sale=DB::table('payments')->where('fk_saleman_id',auth()->user()->id)->sum('amount');

      return response()->json([
        'today_sales' => $todaySales,
        'total_sale' => $ticketsSold,
        'total_amount' => $Sale,
      ],200);
    }


}
