<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus as Status;
use Exception;
use Illuminate\Support\Facades\Session;

class OrderStatus extends Controller
{
    public function saveComment($cartId=null, Request $request)
    {       $cartId;
            $orderId = $cartId;
            $comment = new Status;

            $comment->orderId = $orderId;
            $comment->comment = $request->comments['comment'];
            $comment->status = $request->comments['status'];

            $comment->save();
            // return \redirect('/InformationCustomer'.$cartId);
            return \redirect('/InformationCustomer')->with('orderStatus','Order Status !!!!');
    }
}
