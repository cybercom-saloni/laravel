<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppLogin extends Controller
{
    public function loginAction()
    {
        return view('login.grid');
    }
}
