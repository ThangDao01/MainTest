<?php

namespace App\Jobs;

use App\Mail\AccountMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mail;
    private $email;
    private $name;
    private $pass;

    public function __construct($mail,$email,$name,$pass)
    {
        //
        $this->mail = $mail;
        $this->email = $email;
        $this->name = $name;
        $this->pass = $pass;
    }

    public function handle()
    {
        $data = array('username'=>$this->name,'pass'=>$this->pass);
        Mail::send('mail.mail-reset', $data, function ($message) {
            $message->to($this->email,$this->name)->subject
            ('E&K - Mail xác nhận tài khoản');
            $message->from('ek.englishforkid@gmail.com', 'EK');
        });
    }
}
