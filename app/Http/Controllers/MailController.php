<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendResetMail;
use App\Mail\AccountMail;
use App\Mail\TestMail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function registerMail($email,$name,$pass)
    {
        $testMail = new AccountMail();
        $sendEmailJob = new SendResetMail($testMail,$email,$name,$pass);
        dispatch($sendEmailJob);
    }
}
