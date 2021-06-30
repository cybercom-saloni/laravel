<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
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
}
