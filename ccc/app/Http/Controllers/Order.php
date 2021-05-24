<?php

namespace App\Http\Controllers;
use App\Models\Order as OrderModel;
use App\Models\Order\OrderItem as OrderItem;
use App\Models\Cart\CartAddress as CartAddress;
use App\Models\Cart\CartItem as CartItem;
use App\Models\Customer as CustomerModel;
use App\Models\Cart as CartModel;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function displayOrderAction(Request $request)
    {
        $cartId = SESSION::get('cartId');
        if($cartId)
        {
           $cart = CartModel::where('id',$cartId)->first();
            $order = new OrderModel;
            $order->customerId = $cart->customerId;
            $order->total = $cart->total;
            $order->discount = $cart->discount;
            $order->paymentId = $cart->paymentId;
            $order->shippingId = $cart->shippingId;
            $order->shippingAmount = $cart->shippingAmount;
            $order->status = 'pending';
            $order->save();
            
            $cartItems = CartItem::where('cartId',$cartId)->get();
            $orderItem = new OrderItem;
            foreach($cartItems as $cartItemId=>$cartItem)
            {
                 $orderItem->product =$cartItem->productId;
                 
                // $discount = $cartItem->discount;
                // echo $price = $cartItem->price;
                // $quantity = $cartItem->quantity;
                // $discountTotal +=$discount * $quantity;
                // $total += ($price - ($discount * $price/ 100)) * $quantity;
            }
            
            // $cartModel = CartModel::find($cartId);
            // $cartModel->delete();
            $view = view('order.grid')->render();
            $response =[
             'element'=>[
                 [
                     'selector'=>'#content',
                     'html'=>$view
                 ]
             ]
            ];
            header('content-type:application/json');
            echo json_encode($response);
            die();
        }

    }
}
