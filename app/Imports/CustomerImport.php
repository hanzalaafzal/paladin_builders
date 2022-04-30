<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Customers;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use DB;
use Http;

class CustomerImport implements ToModel, WithHeadingRow,WithValidation,WithUpserts
{
    /**
    * @param Collection $collection
    */
    use Importable;

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
    private function insertPaymentDetails($qty){
      $payment_id=DB::table('payments')->insertGetId([
        'amount' => 1000*$qty,
        'payment_date' => date('Y-m-d'),
        'payment_method' => 'Admin',
          'created_at' => Carbon::now(),
          'payment_status' => 1,
      ]);
      return $payment_id;
    }
    public function model(array $row)
    {
        $test= Customers::create([
            'customer_name' => $row['name'],
            'customer_cnic' => $row['cnic'],
            'customer_number' => $row['number'],
            'customer_network' => $row['network']
        ]);

          $ticket_no=$this->generateTickerNo($row['number']);
          $data=array(
            'ticket_number' => $ticket_no,
            'fk_customer' => $test->customer_id,
            'fk_payment_id' => $this->insertPaymentDetails($row['quantity']),
            'created_at' => Carbon::now(),
            'quantity' => $row['quantity']
          );
          DB::table('tickets')->insert($data);
          $this->sendSms($row['network'],$row['number'],$ticket_no);

        return $test;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|unique:customers,customer_cnic',
            'cnic' => 'required',
            'number' => 'required',
            'network' => 'required'

        ];
    }

    public function uniqueBy()
    {
        return 'customer_cnic';
    }



    public function customValidationMessages()
    {
        return [
            'name.*' => 'Name is missing',
            'cnic.*' => 'Cnic is missing',
            'number.*' => 'Number is missing',
            'network.*' => 'Network is missing',
        ];
    }
}
