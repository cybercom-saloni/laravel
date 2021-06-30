<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus as Status;
use App\Models\Order as OrderModel;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderStatus extends Controller
{
    public function saveComment($cartId=null, Request $request)
    {     
       
        $validator = Validator::make($request->all(), [
            "comments.comment" => "required",
            "comments.status" => "required",
        ]);
        
        if ($validator->fails()) {
            
            // return response()->json(['success'=>'Added new records.']);
            return response()->json(['error'=>$validator->errors()->all()]);
        }  
        $orderId = $cartId;
            $comment = new Status;

            $comment->orderId = $orderId;
            $comment->comment = $request->comments['comment'];
            $comment->status = $request->comments['status'];

            $comment->save();
            $order = OrderModel::find($orderId);
            $order->status = $request->comments['status'];
             $order->save();
            // return \redirect('/InformationCustomer'.$cartId);
            
            return \redirect('InformationCustomer/'.$cartId)->with('orderStatus','Order Status Saved!!!!');
    }
}
