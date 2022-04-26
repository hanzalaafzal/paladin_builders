<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class AuthenticationController extends Controller
{
  public function auth(Request $request){
    $request->validate([
        'email' => 'required|exists:admin,email',
        'password' => 'required',
    ],[
      'email.exists' => 'Incorrect credentials',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::guard('admin')->attempt($credentials)) {
      return redirect()->route('get.dashboard');
    }
    return redirect()->back()->withError('Incorrect credentials');
  }

  public function logout(){

    Auth::logout();

    return redirect()->route('login');
  }

  public function viewDashboard(){

    $thisMontSales=DB::table('payments')->where('payment_status','=',1)->whereMonth('created_at','=',date('m'))->sum('amount');
    $tickets=DB::table('tickets')->count();
    return view('panel.dashboard',compact('thisMontSales','tickets'));
  }
}
