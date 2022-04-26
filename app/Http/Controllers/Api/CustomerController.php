<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Http;


class CustomerController extends Controller
{
    private $rules=array(
      'name' => 'required|max:100|min:3',
      'network' => 'required|in:Jazz,Telenor,Ufone,Zong,Warid',
      'number' => "required",
      'cnic' => 'required|min:15|max:15|regex:/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/',
      'quantity' => 'required|in:1,2,3,4,5,6,7,8,9,10'
    );

    private $messages=array(
      'name.required' => 'Please provide your name',
      'name.max' => 'Name can only be 100 characters long',
      'name.min' => 'Name must atleast contain 3 characters',
      'network.required' => 'Please select network',
      'network.in' => 'Network not found',
      'number.required' => 'Please provide your number',
      'cnic.required' => 'Please provide your cnic number as per pattern',
      'cnic.min' => 'Wrong Cnic',
      'cnic.max' => 'Wrong Cnic ',
      'cnic.regex' => 'Incorrect Cnic format',
      'quantity.required' => 'Please specify the quantity.',
      'quantity.in' => 'Quantity Limit exceeds',
    );

    private function insertUserData($name,$cnic,$number,$network){
      $data=array(
        'customer_name' => $name,
        'customer_cnic' => $cnic,
        'customer_number' => $number,
        'customer_network' => $network,
        'created_at' => Carbon::now(),
      );
      $id=DB::table('customers')->insertGetId($data);
      return $id;

    }

    private function checkCustomer($cnic){
      $user=DB::table('customers')->where('customer_cnic',$cnic)->count();
      if($user>0){
        return true;
      }else{
        return false;
      }
    }

    private function insertPaymentDetails(){
      $payment_id=DB::table('payments')->insertGetId([
        'amount' => 1000,
        'payment_date' => date('Y-m-d'),
        'payment_method' => 'Sale man',
        'fk_saleman_id' => auth()->user()->id,
          'created_at' => Carbon::now(),
      ]);
      return $payment_id;
    }

    private function sendSms($network,$number,$ticket_no){
      try{
        $response=Http::asForm()->post('https://api.veevotech.com/sendsms',[
          'hash' => '07b6dbaf852ccf9815dc94a43c80bc2c',
          'receivenum' => $number,
          'sendernum' => '8583',
          'receivernetwork' => $network,
          'textmessage' => 'Your Ticket No is '.$ticket_no.'\n '.route('get.ticket',$ticket_no),
        ]);

      }catch(\Exception $ex){

      }
    }

    private function generateTickerNo($number){
      $ticket= substr($number, -3).'-'.$this->generateRandomString(6);
      return $ticket;
    }

    private function generateRandomString($length){
      $include_chars = "0123456789ABCDEFGHZ";
      $charLength = strlen($include_chars);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $include_chars [rand(0, $charLength - 1)];
      }
      return $randomString;
    }

    private function getUserId($cnic){
      $user=DB::table('customers')->where('customer_cnic',$cnic)->select('customer_id')->get()->toArray();
      return $user[0]->customer_id;
    }

    public function newOrder(Request $req){
      $validate=Validator::make($req->all(),$this->rules,$this->messages);
      if ($validate->fails()) {
          return response()->json(['error' => $validate->messages()], 500);
      }

      try{
        DB::beginTransaction();
        if($this->checkCustomer($req->cnic)){
          $userId=$this->getUserId($req->cnic);
        }else{
          $userId=$this->insertUserData($req->name,$req->cnic,$req->number,$req->network);
        }


        for($i=0;$i<(int)$req->quantity;$i++){
          $ticket_no=$this->generateTickerNo($req->number);
          $data=array(
            'ticket_number' => $ticket_no,
            'fk_customer' => $userId,
            'fk_payment_id' => $this->insertPaymentDetails(),
            'fk_saleman' => auth()->user()->id,
            'created_at' => Carbon::now(),
          );
          DB::table('tickets')->insert($data);
          $this->sendSms($req->network,$req->number,$ticket_no);

        }


        DB::commit();

        return response()->json([
          'status' => 'success'
        ],200);

      }catch(\Exception $ex){
        DB::rollBack();
        return response()->json(['error' => $ex->getMessage()], 500);
      }
      //check if user exists or not;
    }

}
