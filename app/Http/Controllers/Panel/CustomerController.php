<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Events\SmsEvent;

class CustomerController extends Controller
{
    public function viewCustomers(){
      return view('panel.pages.view_customer');
    }

    public function ajaxCustomers(){
      $data=DB::table('customers')->leftjoin('users','added_by','=','users.id')->select('customers.*','users.name')->orderBy('customer_id','DESC');
      return DataTables::queryBuilder($data)->toJson();
    }

    public function uploadCSV(Request $req){
      // dd($req->all());
      $req->validate([
        'file' => 'file'
      ],[

        'file.file' => 'Please upload csv file only.',
      ]);
      $fileExt=$req->file->getClientOriginalExtension();
      if(Str::upper($fileExt) != 'CSV'){
        return redirect()->back()->withError(['error'=>'Please upload csv file only.']);
      }

      try{
        Excel::import(new CustomerImport, request()->file('file'),null, \Maatwebsite\Excel\Excel::CSV);
        session()->flash('success','Record added');
        return redirect()->back();
      }catch(\Exception $ex){
        dd($ex->getMessage());
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

      $id=DB::table('customers')->insertGetId($data);
      return $id;
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

    public function newCustomer(Request $req){
      $req->validate([
        'name' => 'required|max:100|min:3',
        'network' => 'required|in:Jazz,Telenor,Ufone,Zong',
        'number' => "required",
        'cnic' => 'required|min:15|max:15|regex:/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/|unique:customers,customer_cnic',
      ],[
        'name.required' => 'Please provide your name',
        'name.max' => 'Name can only be 100 characters long',
        'name.min' => 'Name must atleast contain 3 characters',
        'network.required' => 'Please select network',
        'network.in' => 'Network not found',
        'number.required' => 'Please provide your number',
        'cnic.required' => 'Please provide your cnic number as per pattern',
        'cnic.min' => 'Wrong Cnic',
        'cnic.max' => 'Wrong Cnic ',
        'cnic.regex' => 'Incorrect Cnic',
        'cnic.unique' => 'Customer already exists',
      ]);
      try{



        DB::beginTransaction();

        $userId=$this->insertUserData($req->name,$req->cnic,$req->number,$req->network);
        $p_id=$this->insertPaymentDetails(1,'IBFT/Admin Verified',$req->quantity);
        $ticket_no=$this->generateTickerNo($req->number);
        DB::table('tickets')->insert([
          'ticket_number' => $ticket_no,
          'quantity' => $req->quantity,
          'fk_customer' => $userId,
          'fk_payment_id' => $p_id,
          'ticket_receipt' => null,
          'fk_saleman' => null,
          'created_at' => Carbon::now(),
        ]);


        DB::commit();

        event(new SmsEvent(array(
          'network' => $req->network,
          'number' => $req->number,
          'ticket_no' => $ticket_no,
          'method' => 'Online',
          'name' => $req->name,
        )));
        session()->flash('success','Customer Added');
        return redirect()->back();
      }catch(\Exception $ex){
        DB::rollBack();
        dd($ex->getMessage());
      }




    }


}
