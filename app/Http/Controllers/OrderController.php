<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use App\Http\Requests\OrderDetails;
use DB;
use Carbon\Carbon;
use App\Events\SmsEvent;

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
      session()->put('QTY',$request->quantity);

      if($request->paymentMethod=='IBFT'){
        $fileName=md5(uniqid().$request->receipt->getClientOriginalName());
        $fileExt=$request->receipt->getClientOriginalExtension();
        $path=request()->file('receipt')->move(base_path().'/public/receipts/',$fileName.'.'.$fileExt);
        $fileName=$fileName.'.'.$fileExt;
        session()->put('FILE',$fileName);
        $route=route('order.success').'?err_code=000&paymentMethod=IBFT';
        return redirect()->to($route);
      }else{
        $data=array(
          'MERCHANT_ID' => $this->merchant_id,
          'MERCHANT_NAME' => $this->merchant_name,
          'TOKEN' => $this->getAccessToken(),
          'PROCCODE' => '00',
          'TXNAMT' => 1000*$request->quantity,
          'CUSTOMER_MOBILE_NO' => $request->number,
          'CUSTOMER_EMAIL_ADDRESS' => 'malikhunzala1337@gmail.com',
          'SIGNATURE' => md5(uniqid()),
          'VERSION' => '1.0',
          'TXNDESC' => 'Purchase ticket for '.$request->name,
          'SUCCESS_URL' => route('order.success'),
          'FAILURE_URL' => route('order.fail'),
          'BASKET_ID' => substr(md5(uniqid(true)), -6),
          'ORDER_DATE' => date('Y-m-d'),
          'CHECKOUT_URL' => 'http://localhost/angro_farm/public/',
        );
        return view('order_form',compact('data'));
      }

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

    private function insertPaymentDetails($payment_status,$payment_method,$quantity){
      $payment_id=DB::table('payments')->insertGetId([
        'amount' => 1000*$quantity,
        'payment_date' => date('Y-m-d'),
        'payment_method' => $payment_method,
        'payment_status' => $payment_status,
        'created_at' => Carbon::now(),
      ]);
      return $payment_id;
    }

    private function insertReferal($link,$quantity){
      $data=DB::table('refrals')->where('ref_link',$link)->get()->toArray();
      DB::table('refrals')->where('ref_link',$link)->update([
        'ref_counts' => $data[0]->ref_counts+$quantity,
      ]);
    }

    private function updateReferer($link,$customer){
      $data=DB::table('refrals')->where('ref_link',$link)->get()->toArray();
      DB::table('customers')->where('customer_id',$customer)->update([
        'fk_refered' => $data[0]->ref_id
      ]);
    }




    public function orderSuccessPage(Request $req){

      dd($req->all());
      try{
        DB::beginTransaction();
        if($req->err_code=='000'){

          $name=session('NAME');
          $cnic=session('CNIC');
          $number=session('NUMBER');
          $network=session('NETWORK');
          $qty=session('QTY');
          if($req->has('paymentMethod') && $req->paymentMethod=='IBFT'){
            $payment_status=0;
            $payment_method='IBFT';
          }else{
            $payment_status=1;
            $payment_method='Online';
          }
          if($this->checkCustomer($cnic)){
            $userId=$this->getUserId($cnic);

          }else{
            $userId=$this->insertUserData($name,$cnic,$number,$network);
          }
          $ticket_no=$this->generateTickerNo($number);
          $data=array(
            'ticket_number' => $ticket_no,
            'fk_customer' => $userId,
            'fk_payment_id' => $this->insertPaymentDetails($payment_status,$payment_method,$qty),
            'created_at' => Carbon::now(),
            'quantity' => $qty,
          );

          if($req->has('paymentMethod') && $req->paymentMethod=='IBFT'){
            $data['ticket_receipt']=session('FILE');
          }

          if(session()->has('REFERAL') && !empty(session('REFERAL'))){
            $this->insertReferal(session('REFERAL'),$qty);
            $this->updateReferer(session('REFERAL'),$userId);
          }


          DB::table('tickets')->insert($data);
        }else{
          session()->flush();
          session()->flash('fail','Your transaction was failed');
          return redirect()->route('index');
          //dd('Your Transaction was Failed');
        }

        DB::commit();

        event(new SmsEvent(array(
          'network' => $network,
          'number' => $number,
          'ticket_no' => $ticket_no,
          'method' => $req->paymentMethod,
          'name' => $name,
        )));

        session()->flush();
        if($req->paymentMethod=='IBFT'){
          return redirect()->route('thankyou_page');
        }else{
          return redirect()->route('get.ticket',$ticket);
        }
      }catch(\Exception $ex){
        DB::rollBack();
        session()->flash('fail','Your transaction was failed');
        return redirect()->route('index');
        //dd($ex->getMessage());
      }

    }

    public function orderFailurePage(Request $req){
      session()->flash('fail','Your transaction was failed');
      return redirect()->route('index');
    }

    public function thankyouPage($ticket){
      return redirect()->route('get.ticket',$ticket);
    }

    public function thankyouPageIBFT(){
      return view('thankyou');
    }
}
