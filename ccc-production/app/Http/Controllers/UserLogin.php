<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class UserLogin extends Controller
{
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user_data=[
            'email' =>$request->get('email'),
            'password' => $request->get('password'),
        ];
        // $credentials = $request->only('email', 'password');
        // print_r($credentials);
        // if (Auth::attempt($credentials)) {
        //    echo 1;
        // }else
        // {
        //     echo 2;
        // }
        // die;

       $user = Customer::where('email',$request->get('email'))->first();
        if($user)
        {
            $userpassword = Crypt::decryptString($user->password);
            if($userpassword ==  $request->get('password'))
            {
                session(['login' =>$user->firstname.' login successfully!!!','loginname'=>$user->firstname]);
                session::save();
                session::forget('invalidUser');
                session::forget('invalidPassword');
                return view('dashboard')->with('success',$user->name);
            }
            else
            {
                session(['invalidPassword' =>'invalid password!!!']);
                session::save();
                session::forget('invalidUser');
                session::forget('logout');
                return view('welcome')->with('error','invalid password!!!');
            }
        }
        else{

            session(['invalidUser' =>'invalid user!!!']);
            session::save();
            session::forget('invalidPassword');
            session::forget('logout');
            return view('welcome')->with('error','invalid user!!!');
        }
        // $credentials = $request->only('email', 'password');
        // print_r($credentials);
        // return view('dashboard');
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function customLogout()
    {
        // session::forget('login');
        session(['logout' =>'logout successfully!!!']);
        session::save();
        return view('welcome');
    }

    public function userLoginAction()
    {
       return view('frontend.login');
    }
    public function checkLoginAction(Request $request)
    {
        $user = Customer::where('email',$request->get('email'))->first();
        if($user)
        {
            $status = $user->status;
            $email_verified_at = $user->email_verified_at;
            if($status == 1 && $email_verified_at != null)
            {
                 $userpassword = Crypt::decryptString($user->password);
                if($userpassword ==  $request->get('password'))
                {
                    session(['login' =>$user->firstname.' login successfully!!!','loginname'=>$user->firstname]);
                    session::save();
                    session::forget('invalidUser');
                    session::forget('invalidPassword');
                    return view('frontend.dashboard')->with('success',$user->name);
                }
                else
                {
                    session(['invalidPassword' =>'invalid password!!!']);
                    session::save();
                    session::forget('invalidUser');
                    session::forget('logout');
                    return redirect('/user/login')->with('error','invalid password!!!');
                }
            }
            else
            {
                echo 45;
                return redirect('/user/login')->with('error','invalid user!!!');
            }


        }
        else{

            session(['invalidUser' =>'invalid user!!!']);
            session::save();
            session::forget('invalidPassword');
            session::forget('logout');
            return redirect('/user/login')->with('error','invalid user!!!');
        }
    }

    public function signupAction()
    {
        return view('frontend.signup');
    }

    public function loginProcessAction(Request $request)
    {
        $id = $request->id;
        $lastInsertedId = new Customer();
        $lastInsertedId =Customer::where('id',$id)->first();
        echo $lastInsertedId->status;
        echo $lastInsertedId->email_verified_at;
        if($lastInsertedId->status == 1)
        {
            return redirect('/user/login')->with('success','Please Sign in Already you have done confirmation');
        }
        elseif($lastInsertedId->status == 'verifiedemail')
        {
            return redirect('/user/login')->with('success','Please wait for the confirmation from Admin');
        }
        else
        {
            date_default_timezone_set('Asia/Kolkata');
            $lastInsertedId['email_verified_at'] = date('Y-m-d h:i:s');
            $lastInsertedId['status'] = 'verifiedemail';
            $lastInsertedId->save();
            return redirect('/user/login')->with('success','Please Wait for confirmation from Admin');
        }
    }
}
