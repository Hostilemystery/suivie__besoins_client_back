<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notifications extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('nanjifreddy@test.com')
        //             ->markdown('emails.notification')
        //             ->with("data",$this->data)
        //             ->attach($this->data['document']->getrealpath(),
        //             [
        //                 'as'=>$this->data['document']->getClientOriginalName(),
        //                 'mime'=>$this->data['document']->getClientMimeType(),
        //             ]);

        $mails= $this->from('nanjifreddy@test.com')
                    ->markdown('emails.notification')
                    ->with("data",$this->data);

                    if (isset($this->data['document'])){
                        $mails->attach($this->data['document'],
                    [
                        'as'=>$this->data['document']->getClientOriginalName(),
                        'mime'=>$this->data['document']->getClientMimeType(),
                    ]);
                    }


                    return $mails;

    }
}
