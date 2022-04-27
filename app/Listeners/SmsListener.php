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
        $response=Http::asForm()->post('https://api.veevotech.com/sendsms',[
          'hash' => '07b6dbaf852ccf9815dc94a43c80bc2c',
          'receivenum' => $event->data['number'],
          'sendernum' => '8583',
          'receivernetwork' => $event->data['network'],
          'textmessage' => 'Your Ticket No is '.$event->data['ticket_no'].'\n '.route('get.ticket',$event->data['ticket_no']),
        ]);

      }catch(\Exception $ex){

      }
    }
}
