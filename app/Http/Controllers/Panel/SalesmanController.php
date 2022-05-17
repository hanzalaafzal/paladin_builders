<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Events\SmsEvent;
use Carbon\Carbon;

class SalesmanController extends Controller
{
    public function viewSalesman(){
      $data=DB::table('users')->orderBy('id','DESC')->get()->toArray();
      return view('panel.pages.view_salesman',compact('data'));
    }

    public function updateSalesMan($id,$action){
      try{
        if($action==0){
          $mac='DISABLED';
        }else{
          $mac='';
        }
          DB::table('users')->where('id',$id)->update([
            'mac_address' => $mac,
          ]);
          session()->flash('success','Status Updated');
          return redirect()->back();
      }catch(\Exception $ex){
          session()->flash('error',$ex->getMessage());
          return redirect()->back();
      }
    }

    public function storeSalesMan(Request $req){
      //dd($req->all());
      try{
        DB::table('users')->insert([
          'name' => $req->name,
          'email' => $req->email,
          'cnic' => $req->cnic,
          'password' => Hash::make($req->password),
          'number' => $req->number,
          'network' => $req->network,
          'created_at' => Carbon::now(),
          'user_type' => 2,
          'mac_address' => '',
        ]);

        session()->flash('success','Salesman Added');
        return redirect()->back();

      }catch(\Exception $ex){
        dd($ex->getMessage());
        session()->flash('error',$ex->getMessage());
        return redirect()->back();
      }
    }
}
