<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SmsEvent;
use Http;

class SmsListener
{

    public function handle(SmsEvent $event)
    {
      try{
        if($event->data['method']=='IBFT'){
          $msg='We have received your request, after payment verification you will receive an eTicket link via SMS. Thank You.';
        }else{

          $msg='Dear '.$event->data['name'].', you have successfully participated in the lucky draw. Your eTicket is ready. Please check your eTicket on this link '.route('get.ticket',$event->data['ticket_no']);

        }
        $response=Http::asForm()->post('https://api.veevotech.com/sendsms',[
          'hash' => '07b6dbaf852ccf9815dc94a43c80bc2c',
          'receivenum' => $event->data['number'],
          'sendernum' => '8583',
          'receivernetwork' => $event->data['network'],
          'textmessage' => $msg,
        ]);

      }catch(\Exception $ex){

      }
    }
}
