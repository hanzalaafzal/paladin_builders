<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TicketController extends Controller
{
    private function getTicketDetails($ticket){
      $data=DB::table('tickets')->where('ticket_number','=',$ticket)->leftjoin('customers','fk_customer','=','customer_id')
      ->select('tickets.*','customers.customer_name')->get()->toArray();
      if(!empty($data)){
        return $data[0];
      }else{
        return false;
      }
    }

    public function showTicket($ticket){
      $data=$this->getTicketDetails($ticket);
      if($data==false){
        return redirect()->back();
      }else{

        return view('ticket2',compact('data'));
      }
    }

    public function referalTicket($link){
      $data=DB::table('refrals')->where('ref_link',$link)->count();
      if($data>0){
        session()->put('REFERAL',$link);
        return redirect()->route('index');
      }else{
        return redirect()->route('index');
      }
    }
}
