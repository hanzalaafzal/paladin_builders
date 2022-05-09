<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Events\SmsEvent;

class SalesmanController extends Controller
{
    public function viewSalesman(){
      $data=DB::table('users')->orderBy('id','DESC')->get()->toArray();
      return view('panel.pages.view_salesman',compact('data'));
    }
}
