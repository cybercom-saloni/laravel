<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Website extends Controller
{
    public function index()
    {

        $data=["name"=>"saloni", 'data'=>"Click the Link For Activation of Account"];
        $user['to']='plantwonder0524@gmail.com';
        Mail::send('emails.myTestMail',$data,function($messages) use($user)
        {
            $messages->to($user['to']);
            $messages->subject('Activation link');
        });
    }
}
