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
          $msg='ہمیں آپ کی درخواست موصول ہوئی ہے، ادائیگی کی تصدیق کے بعد آپ کو بذریعہ ایس ایم ایس ای ٹکٹ کا لنک موصول ہوگا۔ شکریہ';
        }else{

          $msg='آپ نے لکی ڈرا میں کامیابی سے حصہ لیا ہے۔ آپ کا ای ٹکٹ تیار ہے۔ براہ کرم اس لنک پر اپنا ٹکٹ چیک کریں ۔ '.$event->data['name'].' آپ کا شکریہ '.route('get.ticket',$event->data['ticket_no']);

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
