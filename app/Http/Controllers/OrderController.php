<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use App\Http\Requests\OrderDetails;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    private $secured_key='6wCMRU49IR5DBjLP1ggwKTcV';
    private $merchant_id='14384';
    private $merchant_name='TechoStudios Pvt Ltd';

    private function getAccessToken(){
      $response=Http::acceptJson()->post('https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken',[
        'secured_key' => $this->secured_key,
        'merchant_id' => $this->merchant_id,
      ]);
      return $response->json()['ACCESS_TOKEN'];

    }

    public function postDetails(OrderDetails $request){
      session()->put('NAME', $request->name);
      session()->put('NUMBER',$request->number);
      session()->put('NETWORK',$request->network);
      session()->put('CNIC',$request->cnic);

      $data=array(
        'MERCHANT_ID' => $this->merchant_id,
        'MERCHANT_NAME' => $this->merchant_name,
        'TOKEN' => $this->getAccessToken(),
        'PROCCODE' => '00',
        'TXNAMT' => 1000,
        'CUSTOMER_MOBILE_NO' => $request->number,
        'CUSTOMER_EMAIL_ADDRESS' => 'malikhunzala1337@gmail.com',
        'SIGNATURE' => md5(uniqid()),
        'VERSION' => '1.0',
        'TXNDESC' => 'Purchase a ticket for '.$request->name,
        'SUCCESS_URL' => route('order.success'),
        'FAILURE_URL' => route('order.fail'),
        'BASKET_ID' => substr(md5(uniqid(true)), -6),
        'ORDER_DATE' => date('Y-m-d'),
        'CHECKOUT_URL' => 'http://localhost/angro_farm/public/',
      );
      return view('order_form',compact('data'));
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

    private function generateTickerNo($number){
      $ticket= substr($number, -3).'-'.$this->generateRandomString(6);
      return $ticket;
    }

    private function insertUserData($name,$cnic,$number,$network){
      $data=array(
        'customer_name' => $name,
        'customer_cnic' => $cnic,
        'customer_number' => $number,
        'customer_network' => $network,
        'created_at' => Carbon::now(),
      );
      if(session()->has('reffer')){
        $data['fk_refered']=session('REFER');
      }

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

    private function getUserId($cnic){
      $user=DB::table('customers')->where('customer_cnic',$cnic)->select('customer_id')->get()->toArray();
      return $user[0]->customer_id;
    }

    private function insertPaymentDetails($payment_status){
      $payment_id=DB::table('payments')->insertGetId([
        'amount' => 1000,
        'payment_date' => date('Y-m-d'),
        'payment_method' => 'Online',
        'payment_status' => $payment_status,
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


    public function orderSuccessPage(Request $req){
      try{
        DB::beginTransaction();
        if($req->err_code=='000'){

          $name=session('NAME');
          $cnic=session('CNIC');
          $number=session('NUMBER');
          $network=session('NETWORK');

          if($this->checkCustomer($cnic)){
            $userId=$this->getUserId($cnic);

          }else{
            $userId=$this->insertUserData($name,$cnic,$number,$network);
          }
          $ticket_no=$this->generateTickerNo($number);
          $data=array(
            'ticket_number' => $ticket_no,
            'fk_customer' => $userId,
            'fk_payment_id' => $this->insertPaymentDetails(),
            'created_at' => Carbon::now(),
          );

          DB::table('tickets')->insert($data);

        }else{
          dd('Your Transaction was Failed');
        }

        DB::commit();
        $this->sendSms($network,$number,$ticket_no);
        session()->flush();
        return redirect()->route('thankyou_page',$ticket_no);
      }catch(\Exception $ex){
        DB::rollBack();
        dd($ex->getMessage());
      }

    }

    public function orderFailurePage(Request $req){
      dd($req->all());
    }

    public function thankyouPage($ticket){
      return redirect()->route('get.ticket',$ticket);
      
    }
}
