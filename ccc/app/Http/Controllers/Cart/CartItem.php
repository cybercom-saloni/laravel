<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\CartItem as CartItemModel;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Session;

class CartItem extends Controller
{
    public function ItemAction(Request $request)
    {
        $cartId = Session::get('cartId');
        $quanities = $request->quantityCart;  
        foreach($quanities as $key => $value){
            // echo $key;
            // echo $value;
            // echo "<BR>";
            $cartItemUpdate = CartItemModel::where('id',$key)->first();
           $cartItemUpdate->quantity = $value;
           $cartItemUpdate->save();
           $cartTotal = 0;
            $discountTotal = 0;
        // $discount = $cartItemUpdate->discount;
        // // $price = $cartItemUpdate->price;
        // $quantity = $cartItemUpdate->quantity;

        // echo $discountTotal += $discount*$quantity;
        
        }
        // echo $cartId;
        $total =0;
        $discountTotal=0;
        $cartItems = CartItemModel::where('cartId',$cartId)->get();
        // print_r($cartItems);
        foreach($cartItems as $cartItemId=>$cartItem)
        {
             $cartItem->productId;
            $discount = $cartItem->discount;
            echo $price = $cartItem->price;
            $quantity = $cartItem->quantity;
            $discountTotal +=$discount * $quantity;
            $total += ($price*$quantity) - ($discount* $quantity);
        }
        
        $cart = CartModel::where('id',$cartId)->first();
        if($cart)
        {
           $cart->discount = $discountTotal;
           echo $cart->total = $total+$cart->shippingAmount;
           $cart->save();

        }
        return \redirect('cart/'.$cartId);   
    }

    public function ItemDeleteAction(Request $request)
    {
        $cartId = Session::get('cartId');
        $cartItemId = $request->id;
        $cartItemModel = CartItemModel::find($cartItemId);
        $cartItemModel->delete();
        return \redirect('cart/'.$cartId);
        
        
    }

    
}
