<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Index1 extends Controller
{
     public function index()
    {
        return 'index1 Action';
    }
    public function addAction()
    {
        return 'add1 Action';
    }
    public function editAction()
    {
        $tot=10+5;
        return $tot;
    }
}
