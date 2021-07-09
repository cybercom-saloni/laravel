<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entityType;
class Entity_Type extends Controller
{
    public function indexAction()
    {
        return view('manageForm.index');
    }
}
