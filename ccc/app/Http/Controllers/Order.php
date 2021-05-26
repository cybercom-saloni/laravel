<?php

namespace App\Http\Controllers;
use App\Models\Order as OrderModel;
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
        $customers = CustomerModel::all();
        $cartId = SESSION::get('cartId');
         $customerId = SESSION::get('customerId');
        
        
        if($cartId)
        {
             $customer = CustomerModel::where('id',$customerId)->first();
           $cart = CartModel::where('id',$cartId)->first();
        //    echo $cart[0]->customerId;
        //    die;
            $order = OrderModel::where('customerId',$customerId)->first();
            // if(!$order)
            // {
            //     $order = new OrderModel;
            // }
            // $order->customerId = $cart->customerId;
            // $order->total = $cart->total;
            // $order->discount = $cart->discount;
            // $order->paymentId = $cart->paymentId;
            // $order->shippingId = $cart->shippingId;
            // $order->shippingAmount = $cart->shippingAmount;
            // $order->status = 'pending';
            // $order->save();
            $orderId = $order->id;
            $cartItems = CartItem::where('cartId',$cartId)->get();
            // $orderItem = OrderItem::where('orderId',$orderId)->get();
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
                //    $product = ProductModel::where('id',$productId)->first();
        

            }
             $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
             $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
            $orderBillingAddress = OrderAddress::where([['orderId',$orderId],['addressType','billing']])->first();
            if(!$orderBillingAddress)
            {
                $orderBillingAddress = new OrderAddress;
            }
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
            
            $orderShippingAddress = OrderAddress::where([['orderId',$orderId],['addressType','shipping']])->first();
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
            $view = view('order.grid',['controller'=>$this,'customer'=>$customers,'orderDetails'=>$orderDetails,'orderItemsDetails'=>$orderItemsDetails,'orderBillingAddressDetails'=>$orderBillingAddressDetails,'orderShippingAddressDetails'=>$orderShippingAddressDetails])->render();
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

    public function displayAllOrderAction()
    {
        $customers = CustomerModel::Join('orders','customers.id','=','orders.customerId')->select('customers.id','customers.firstname','customers.lastname','customers.email','customers.contactno')->get();
        // $customers = CustomerModel::all();
        $orderId = Session::get('orderId');
         $customerId = Session::get('ordercustomerId');
         if(!$customerId)
         {
             
            $customer = CustomerModel::first();
            $customerId = $customer->id;
            Session::put('ordercustomerId',$customerId);
            $customerDetails = CustomerModel::where('id',$customerId)->first();
            $order = OrderModel::where('customerId',$customerId)->first();
         }
         if(!$orderId)
         {
           
            $order = OrderModel::first();
            $orderId = $order->id;
            Session::put('orderId',$orderId);
            $orderDetails = OrderModel::where('id',$orderId)->first();
            // $customerDetails = CustomerModel::where('id',$orderId)->first();
            // $order = OrderModel::where('orderId',$orderId)->first();
         }
         $order = OrderModel::where('customerId',$customerId)->first();
            $orderDetails = OrderModel::where('id',$orderId)->first();
            $customerDetails = CustomerModel::where('id',$customerId)->first();
           $orderItemsDetails = OrderItem::where('orderId',$orderId)->get();
           $orderBillingAddressDetails = OrderAddress::where([['orderId',$orderId],['addressType','billing']])->get();
           $orderShippingAddressDetails = OrderAddress::where([['orderId',$orderId],['addressType','shipping']])->get();
            $view = view('order.information',['controller'=>$this,'customerDetails'=>$customerDetails,'customers'=>$customers,'orderDetails'=>$orderDetails,'orderItemsDetails'=>$orderItemsDetails,'orderBillingAddressDetails'=>$orderBillingAddressDetails,'orderShippingAddressDetails'=>$orderShippingAddressDetails])->with('changeCustomer','customer Changed!!!')->render();
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

    public function saveCustomerAction($cartId=null,Request $request)
    {
        echo $request->customer;
        Session::put('ordercustomerId', $request->customer);
      echo $customerId =Session::get('ordercustomerId');
         echo $cart = OrderModel::where('customerId', $customerId)->first();
        if(!$cart)
        {
            echo 111;
            return \redirect('/order/Information')->with('notorder','Order Not Found!!!!');
        }
        if($cart)
        {

            echo   $orderId = $cart->id;
              Session::put('orderId',$orderId);
              return \redirect('/order/Information'.$cartId);
        }  
    }


    public function saveStatusAction(Request $request)
    {
      
        print_r($request->get('status'));
        echo $request->customer;
        echo $request->status;
      
        
    }
}

