<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Object_;

class AccountController extends Controller
{
    //
    function randomPass()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < 10; $i++)
            $result .= $characters[mt_rand(0, 61)];
        return $result;
    }

    public function listAccount()
    {
        return view('admin.account-list', [
            'ListAccount' => Account::all(),
        ]);
    }

    public function LoginForm()
    {
        return view('admin.login-form');
    }

    public function LoginPost(Request $request)
    {
        $arr = [
            'email' => $request->get('Email'),
            'password' => $request->get('Password'),
        ];
        if (Auth::attempt($arr)) {
            $account = Account::where('email', '=', $request->get('Email'))->first();
            if ($account->Status == 1) {
                return 2;
            }
            $account->Status = 1;
            $account->save();
            Session::put('account',$account);
            return 1;
        } else {
            return 3;
        }
    }

    public function RegisterForm()
    {
        return view('admin.register-form');
    }

    public function RegisterPost(Request $request)
    {
        if (Account::where('email', '=', $request->get('email'))->first()) {
            Session::flash('message', 'Invalid email try another email');
            Session::flash('style', 'danger');
            return 2;
        }
        $obj = new Account();
        $obj->FullName = $request->get('fullName');
        $obj->UserName = $request->get('userName');
        $obj->email = $request->get('email');
        $pass = $this->randomPass();
        $obj->password = bcrypt($pass);
        (new MailController)->registerMail($obj->email, $obj->FullName, $pass);
        $obj->Status = 0;
        $obj->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $obj->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $obj->save();
        Session::flash('message', 'Account created successfully<br/> <strong>Please check your email to receive the password</strong>');
        Session::flash('style', 'success');
        return 1;

//        return redirect('/account/login');
    }

    public function enter_Email_Form()
    {
        return view('enter-email-form');
    }

    public function enter_Email(Request $request)
    {
        $account = Account::where('email', '=', $request->get('email'))->first();
        if (!$account) {
            Session::flash('message', 'Invalid email try another email');
            Session::flash('style', 'danger');
            return redirect('/enter-email');
        }
        return redirect('/rs-pass/' . $account->email);
    }

    public function rs_Password_Form($email)
    {
        $account = Account::where('email', '=', $email)->first();
        $pass = $this->randomPass();
        $account->password = bcrypt($pass);
        (new MailController)->registerMail($account->email, $account->FullName, $pass);
        $account->save();
        Session::flash('message', 'Chúng tôi đã gửi mật khẩu mới đến mail của bạn');
        Session::flash('style', 'success');
        return view('rs-password-form', [
            'email' => $email
        ]);
    }
    public function new_Password($email)
    {
        $account = Account::where('email', '=', $email)->first();
        if ($account){
            $pass = $this->randomPass();
            $account->password = bcrypt($pass);
            (new MailController)->registerMail($account->email, $account->FullName, $pass);
            $account->save();
            return 1;
        }
        return 2;
    }

    public function rs_Password(Request $request, $email)
    {
        $arr = [
            'email' => $email,
            'password' => $request->get('password'),
        ];
        if (!Auth::attempt($arr)) {
//            Session::flash('message', 'Sai mật khẩu vui lòng nhập lại');
//            Session::flash('style', 'danger');
////            return back();
//            dd('Sai mật khẩu vui lòng nhập lại');
            return 2;
        }
        $account = Account::where('email', '=', $email)->first();
        $account->password = bcrypt($request->get('new-Password'));
        (new MailController)->registerMail($account->email, $account->FullName, $request->get('new-Password'));
        $account->save();
//        Session::flash('message', 'Đổi mật khẩu thành công');
//        Session::flash('style', 'success');
        return 1;
    }

    public function userInformation(){
        if (Session::has('account')){
            return Session::get('account');
        }
       return User::all('email','password');
    }
    public function test(Request $request){
        $arr = [
            'email' => 'thangdao202@gmail.com',
            'password' => 'DXYLob2DVI',
        ];
        Auth::attempt($arr);
    }
}
