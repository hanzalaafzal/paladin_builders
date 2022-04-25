<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TicketController extends Controller
{
    private function getTicketDetails($ticket){
      $data=DB::table('tickets')->where('ticket_number','=',$ticket)->leftjoin('customers','fk_customer','=','customer_id')->get()->toArray();
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
        return view('ticket',compact('data'));
      }
    }
}
