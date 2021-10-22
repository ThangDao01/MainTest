<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function handle()
    {
//        dd($this->mail);
//        Mail::send($this->mail);
        $data = array('title' => 'Xin chao vietnam', 'content' => 'Day la noi dung');
        $name = 'Đào Thắng';
        $email = 'thangdao202@gmail.com';
        Mail::send('mail.mail-reset', $data, function ($message) use ($name, $email) {
            $message->to($email,$name)->subject
            ('E&K - Cảm ơn đã sử dụng dịch vụ của chúng tôi');
            $message->from('ek.englishforkid@gmail.com', 'EK');
        });
    }
}
