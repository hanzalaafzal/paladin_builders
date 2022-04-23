<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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

        dd('done');

    }
    return redirect()->back()->withError('Incorrect credentials');
  }

  public function logout(){

    Auth::logout();

    return redirect()->route('login');
  }
}
