<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;
use App\Events\SmsEvent;


class TicketsController extends Controller
{
    public function viewTickets(){
      return view('panel.pages.view_tickets');
    }
    public function ajaxTickets(){
      $data=DB::table('tickets')->join('customers','fk_customer','=','customers.customer_id')
      ->join('payments','fk_payment_id','=','payments.payment_id')
      ->leftjoin('users','fk_saleman','=','users.id')
      ->select('tickets.*','customers.customer_id','customers.customer_name','users.id','users.name','payments.amount','payments.payment_status','payments.fk_saleman_id','payments.payment_method')
      ->orderBy('ticket_id','DESC');
      return DataTables::queryBuilder($data)->toJson();
    }

    public function updateTicket($ticket,$status){
      try{
        DB::beginTransaction();
        $paymentID=DB::table('tickets')->where('ticket_number',$ticket)
        ->leftjoin('customers','fk_customer','=','customers.customer_id')->get()->toArray();
        DB::table('payments')->where('payment_id',$paymentID[0]->fk_payment_id)->update([
          'payment_status' => $status,
        ]);


        DB::commit();
        

        event(new SmsEvent(array(
          'network' => $paymentID[0]->customer_network,
          'number' => $paymentID[0]->customer_number,
          'ticket_no' => $ticket,
          'method' => 'Online',
          'name' => $paymentID[0]->customer_name,
        )));

        session()->flash('success','Payment Verified');
        return redirect()->back();
      }catch(\Exception $ex){
        DB::rollBack();
        dd($ex->getMessage());
      }
    }
}
