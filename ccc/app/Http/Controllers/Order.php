<?php

namespace App\Http\Controllers;
use App\Models\Order as OrderModel;
use App\Models\OrderStatus as Comments;
use App\Models\Order\OrderItem as OrderItem;
use App\Models\Order\OrderAddress as OrderAddress;
use App\Models\Cart\CartAddress as CartAddress;
use App\Models\Cart\CartItem as CartItem;
use App\Models\Customer as CustomerModel;
use App\Models\Cart as CartModel;
use App\Models\Product as ProductModel;

use App\Models\Shipping;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function displayOrderAction(Request $request)
    {
        try
        {
            $cartId = SESSION::get('cartId');
            $customerId = SESSION::get('customerId');
            if(!$cartId)
            {
              throw new Exception('cartId Not Found!!!');  
            }
            if(!$customerId)
            {
              throw new Exception('customer Id Not Found!!!');  
            }
            if($cartId)
            {
                $customer = CustomerModel::where('id',$customerId)->first();
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
                $order = OrderModel::where('customerId',$customerId)->latest()->first();
                if(!$order)
                {
                    throw new Exception('customer Id Not Found!!!');  
                }
                $orderId = $order->id;
                $orderItem = OrderItem::where('orderId',$orderId)->get();
                $cartItems = CartItem::where('cartId',$cartId)->get();
                foreach($cartItems as $cartItemId=>$cartItem)
                {
                   
                     $orderItem = new OrderItem;
                     $orderItem->productId =$cartItem->productId;
                     $orderItem->orderId = $orderId;
                     $orderItem->discount = $cartItem->discount;
                     $orderItem->basePrice = $cartItem->basePrice;
                     $orderItem->price = $cartItem->price;
                     $orderItem->quantity = $cartItem->quantity;
                     $orderItem->save();
                     $cartItemModel = CartItem::find($cartItem->id);
                     $cartItemModel->delete();
                     $productId =  $orderItem->productId;
                     $product = ProductModel::where('id',$productId)->first();
                }
                echo $cartId;
                echo $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->latest()->first();
                if(!$cartShippingAddress)
                {
                    echo 1234;
                }
                die;
                $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->latest()->first();
               $orderBillingAddress = OrderAddress::where([['orderId',$orderId],['addressType','billing']])->latest()->first();
               
            
               $orderBillingAddress = new OrderAddress;   
               $orderBillingAddress->addressId = 1;
               $orderBillingAddress->orderId = $orderId;    
               $orderBillingAddress->address = $cartBillingAddress->address;
               $orderBillingAddress->area = $cartBillingAddress->area;
               $orderBillingAddress->city = $cartBillingAddress->city;
               $orderBillingAddress->state = $cartBillingAddress->state;
               $orderBillingAddress->zipcode = $cartBillingAddress->zipcode;
               $orderBillingAddress->country = $cartBillingAddress->country;
               $orderBillingAddress->addressType = $cartBillingAddress->addressType;
               $orderBillingAddress->save();
               $cartBillingAddressDelete = CartAddress::find($cartBillingAddress->id);
               $cartBillingAddressDelete->Delete();
               
               $orderShippingAddress = OrderAddress::where([['orderId',$orderId],['addressType','shipping']])->latest()->first();
               if(!$orderShippingAddress)
               {
                   $orderShippingAddress = new OrderAddress;
               }
               $orderShippingAddress->addressId = 1;
               $orderShippingAddress->orderId = $orderId;
               $orderShippingAddress->address = $cartShippingAddress->address;
               $orderShippingAddress->area = $cartShippingAddress->area;
               $orderShippingAddress->city = $cartShippingAddress->city;
               $orderShippingAddress->state = $cartShippingAddress->state;
               $orderShippingAddress->zipcode = $cartShippingAddress->zipcode;
               $orderShippingAddress->country = $cartShippingAddress->country;
               $orderShippingAddress->addressType = $cartShippingAddress->addressType;
               $orderShippingAddress->save();
               $cartShippingAddressDelete = CartAddress::find($cartShippingAddress->id);
               $cartShippingAddressDelete->Delete();
   
              $orderDetails = OrderModel::where('id',$orderId)->latest()->first();
              $orderItemsDetails = OrderItem::where('orderId',$orderId)->get();
              $orderBillingAddressDetails = OrderAddress::where([['orderId',$orderId],['addressType','billing']])->get();
              $orderShippingAddressDetails = OrderAddress::where([['orderId',$orderId],['addressType','shipping']])->get();
           }
           $cartModel = CartModel::find($cartId);
               $cartModel->delete();
               $view = view('order.grid',['controller'=>$this,'customer'=>$customer,'orderDetails'=>$orderDetails,'orderItemsDetails'=>$orderItemsDetails,'orderBillingAddressDetails'=>$orderBillingAddressDetails,'orderShippingAddressDetails'=>$orderShippingAddressDetails])->render();
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
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function getProductName($id)
    {
        $product = ProductModel::where('id', $id)->first();
        return $product->name;
    }

    public function getPaymentName($id)
    {
        $payment = Payment::where('id', $id)->first();
        return $payment->name;
    }

    public function getShippingName($id)
    {
        $shipping = Shipping::where('id', $id)->first();
        return $shipping->name;
    }
}

