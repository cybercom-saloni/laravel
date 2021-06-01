<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart\CartItem as CartItemModel;
use App\Models\Cart as CartModel;
use App\Models\Product;
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
            $price = $cartItem->basePrice;
            $quantity = $cartItem->quantity;
            $discountTotal +=$discount * $quantity;
            $total += ($price - ($discount * $price/ 100)) * $quantity;
        }
       
        
        $cart = CartModel::where('id',$cartId)->first();
        if($cart)
        {
           $cart->discount = $discountTotal;
           echo $cart->total = $total+$cart->shippingAmount;
           $cart->save();
        }
        return \redirect('cart/'.$cartId)->with('updateqty','cart Item quantity updated');  
        // return \redirect('cart/'.$cartId);   
    }

    public function ItemDeleteAction(Request $request)
    {
        $total =0;
        $discountTotal=0;
        $cartId = Session::get('cartId');
        $cartItemId = $request->id;
        $cartItemModel = CartItemModel::find($cartItemId);
        $cartItemModel->delete();
         $cartItems = CartItemModel::where('cartId',$cartId)->get();
         foreach($cartItems as $cartItemId=>$cartItem)
        {
             $cartItem->productId;
            $discount = $cartItem->discount;
            $price = $cartItem->price;
            $quantity = $cartItem->quantity;
            $discountTotal +=$discount * $quantity;
            $total += ($price - ($discount * $price/ 100)) * $quantity;
        }
        
        $cart = CartModel::where('id',$cartId)->first();
        if($cart)
        {
           $cart->discount = $discountTotal;
           echo $cart->total = $total+$cart->shippingAmount;
           $cart->save();

        }
        return \redirect('cart/'.$cartId)->with('deletecartItem','cart Item deleted!!!'); 
        
        
    }

    
    public function addItemAction(Request $request)
    {
    
         $productIds = $request->products;
        //  print_r($productIds);
        $cartId = SESSION::get('cartId');
       
        foreach($productIds as $key=>$productId)
        {
            $cartItem = CartItemModel::where([['cartId', $cartId], ['productId', $productId]])->first();
            if(!$cartItem)
            {
                $product = Product::where('id',$productId)->first();
                $cartItem = new CartItemModel;
                $cartItem->cartId = $cartId;
                $cartItem->productId = $productId;
                $cartItem->quantity = 1;
                $cartItem->basePrice = $product->price;
                $cartItem->price = $product->price;
                $cartItem->discount = $product->discount;
                $cartItem->save();
            }else{
                $cartItem->quantity +=1;
                $cartItem->price = $cartItem->quantity * $cartItem->basePrice;
                $cartItem->save();
            }

        }
        return \redirect('cart/'.$cartId)->with('addItem','cart Item added!!!'); 
    }


  
}
