<?php

namespace App\Http\Controllers;
use App\Models\Customer as CustomerModel;
use App\Models\Cart as CartModel;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart\CartAddress as CartAddress;
use App\Models\Cart\CartItem as CartItem;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\Category as CategoryModel;

class Cart extends Controller
{
    protected $customerId = null;
    public function addToCartAction(Request $request)
    {
        $productId = $request->id;
        $customers = CustomerModel::all();
        $customer = CustomerModel::first();
        $customerId = $customer->id;
        
        if($customerId)
        {
            $cart = CartModel::where('customerId',$customerId)->first();
            $cartId = $cart->id;
            $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
            $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
            // echo $cartBillingAddress;
        }else
        {
            $cartId = Session::get('cartId');
        }
            $cartItemAdd = CartItem::where([['cartId', $cartId], ['productId', $productId]])->first();
            if($cartItemAdd)
            {
                $cartItemAdd->quantity += 1;
                $cartItemAdd->save();
            }
            if(!$cartItemAdd)
            {
                $cartItemAdd = new CartItem;
                $productData = Product::where('id',$productId)->first();
                if($productData)
                {
                    $cartItemAdd->productId = $productId;
                    $cartItemAdd->cartId = $cartId;
                    $cartItemAdd->quantity = 1;
                    $cartItemAdd-> basePrice = $productData->price;
                    $cartItemAdd-> price = $productData->price;
                    $cartItemAdd-> discount = $productData->discount;
                    $cartItemAdd->save();
                }
               
            }
            
                // echo $cartId;
        // if($productId)
        // {
        //     // $cartItem = CartItem::where([['cartId', $cart->id], ['productId', $productId]])->first();
        //     $cartItemAdd = CartItem::where([['cartId', $cartId], ['productId', $productId]])->first();
        //     if(!$cartItemAdd)
        //     {
        //         echo 1111;
        //         // $cartItemAdd = new CartItem;
        //         // $productData = Product::where('id',$productId)->first();
        //         // $cartItemAdd->productId = $productId;
        //         // $cartItemAdd->cartId = $cartId;
        //         // $cartItemAdd->quantity = 1;
        //         // $cartItemAdd-> basePrice = $productData->price;
        //         // $cartItemAdd-> price = $productData->price;
        //         // $cartItemAdd-> discount = $productData->discount;
        //         // $cartItemAdd->save();
        //     }else
        //     {

        //     }
        
        //     $productData = Product::where('id',$productId)->first();
        //         $cartItemAdd->productId = $productId;
        //         $cartItemAdd->cartId = $cartId;
        //         $cartItemAdd->quantity = $productData->quantity;
        //         $cartItemAdd-> basePrice = $productData->price;
        //         $cartItemAdd-> price = $productData->price;
        //         $cartItemAdd-> discount = $productData->discount;
        //         $cartItemAdd->save();
        // }
        if($cartId)
        {
          $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
          $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
          $cartItems = CartItem::where('cartId',$cartId)->get();
          $cartView = CartModel::where('id',$cartId)->first();
          $pagination = ProductModel::paginate(2);  
          $view = view('cart.grid',['productId'=> $productId,'products'=>$pagination,'customers'=>$customers,'cart'=>$cartView,'cartItems'=>$cartItems,'customerId'=>$customerId,'controller'=>$this,'cartId'=>$cartId,'shipping'=>$cartShippingAddress,'billing'=>$cartBillingAddress])->render();
        }else
        {
            $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
            $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
            $view = view('cart.grid',['productId'=> $productId,'customers'=>$customers,'controller'=>$this])->render();
        }
       
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

    public function fetch_cartdata(Request $request)
    {
        if($request->ajax())
        {
            $productId = $request->id;
            $customers = CustomerModel::all();
            $customer = CustomerModel::first();
            $customerId = $customer->id;
            
            if($customerId)
            {
                $cart = CartModel::where('customerId',$customerId)->first();
                $cartId = $cart->id;
                $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
                $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
                // echo $cartBillingAddress;
            }else
            {
                $cartId = Session::get('cartId');
            }
                $cartItemAdd = CartItem::where([['cartId', $cartId], ['productId', $productId]])->first();
                if($cartItemAdd)
                {
                    $cartItemAdd->quantity += 1;
                    $cartItemAdd->save();
                }
                if(!$cartItemAdd)
                {
                    $cartItemAdd = new CartItem;
                    $productData = Product::where('id',$productId)->first();
                    if($productData)
                    {
                        $cartItemAdd->productId = $productId;
                        $cartItemAdd->cartId = $cartId;
                        $cartItemAdd->quantity = 1;
                        $cartItemAdd-> basePrice = $productData->price;
                        $cartItemAdd-> price = $productData->price;
                        $cartItemAdd-> discount = $productData->discount;
                        $cartItemAdd->save();
                    }
                   
                }
                
                    // echo $cartId;
            // if($productId)
            // {
            //     // $cartItem = CartItem::where([['cartId', $cart->id], ['productId', $productId]])->first();
            //     $cartItemAdd = CartItem::where([['cartId', $cartId], ['productId', $productId]])->first();
            //     if(!$cartItemAdd)
            //     {
            //         echo 1111;
            //         // $cartItemAdd = new CartItem;
            //         // $productData = Product::where('id',$productId)->first();
            //         // $cartItemAdd->productId = $productId;
            //         // $cartItemAdd->cartId = $cartId;
            //         // $cartItemAdd->quantity = 1;
            //         // $cartItemAdd-> basePrice = $productData->price;
            //         // $cartItemAdd-> price = $productData->price;
            //         // $cartItemAdd-> discount = $productData->discount;
            //         // $cartItemAdd->save();
            //     }else
            //     {
    
            //     }
            
            //     $productData = Product::where('id',$productId)->first();
            //         $cartItemAdd->productId = $productId;
            //         $cartItemAdd->cartId = $cartId;
            //         $cartItemAdd->quantity = $productData->quantity;
            //         $cartItemAdd-> basePrice = $productData->price;
            //         $cartItemAdd-> price = $productData->price;
            //         $cartItemAdd-> discount = $productData->discount;
            //         $cartItemAdd->save();
            // }
            if($cartId)
            {
              $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
              $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
              $cartItems = CartItem::where('cartId',$cartId)->get();
              $cartView = CartModel::where('id',$cartId)->first();
              $pagination =  ProductModel::paginate(2);
            }
            return view('cart.grid',['productId'=> $productId,'products'=>$pagination,'customers'=>$customers,'cart'=>$cartView,'cartItems'=>$cartItems,'customerId'=>$customerId,'controller'=>$this,'cartId'=>$cartId,'shipping'=>$cartShippingAddress,'billing'=>$cartBillingAddress])->render();
        }
    }

    public function getCategoryName($id)
    {
        $categoryModel = new CategoryModel();
        $categoryName =  CategoryModel::find($id);
        // print_r($categoryName);
        foreach($categoryName as $value)
        {
            $categoryName = $value->name;
        }
        // return $categoryName->getCategories()->id;
        return $categoryName;
    }

    public function getCustomers($id=null)
    {
        $customers = CustomerModel::all();
    }

    public function getProductName($id)
    {
        $product = Product::where('id', $id)->first();
        return $product->name;
    }
    public function getProductPrice($id)
    {
        $product = Product::where('id', $id)->first();
        return $product->price;
    }

    public function saveCustomerAction($cartId=null,Request $request)
    {
        Session::put('customerId', $request->customer);
        // Session::put('cartId', $cartId);
      $customerId =Session::get('customerId');

        //echo $customerId = $request->customer;
         $cart = CartModel::where('customerId', $customerId)->first();
        if(!$cart)
        {
           $cart = new CartModel;
           $cart->customerId = $customerId;
           $cart->paymentId = 1;
           $cart->shippingId = 1;
           $cart->save();
        }     
        $cartId = $cart->id;
        Session::put('cartId',$cartId);
        return \redirect('cart/'.$cartId);
        // if(Session::get('cartId'))
        // {
        //   $customers = CustomerModel::all();
        //   $cartId = Session::get('cartId');
        //   $cartShippingAddress = CartAddress::where([['cartId',$cartId],['addressType','shipping']])->first();
        //   $cartBillingAddress = CartAddress::where([['cartId',$cartId],['addressType','billing']])->first();
        //   $view = view('cart.grid',['customers'=>$customers,'controller'=>$this,'cartId'=>$cartId,'shipping'=>$cartShippingAddress,'billing'=>$cartBillingAddress])->render();
        //   $response =[
        //     'element'=>[
        //         [
        //             'selector'=>'#content',
        //             'html'=>$view
        //         ]
        //     ]
        //    ];
        //    header('content-type:application/json');
        //    echo json_encode($response);
        //    die();
        // }
        // if($customerId)
        // {
        //     $cartIdData = CartModel::where('customerId','=',$customerId)->get();
          
        //     // if($cartIdData[0]->customerId == $customerId)
        //     // {
        //     //     $cartIdData->update();
        //     // }
        //     $cartIdData = new CartModel;
        //     $cartIdData->customerId = $customerId;
        //     $cartIdData->paymentId = 0;
        //     $cartIdData->shippingId = 0;
        //     $cartIdData->save();
        // }
        // $cartId= $cartIdData[0]->cartId;
        // echo 'in session';
       
        // $cartData = CartModel::updateOrInsert(['cartId'=>$cartId],['total'=>0,'discount'=>0,'paymentId'=>0,'shippingId'=>0,'shippingAmount'=>0,'customerId'=>$value]);
    }
   
    public function getPayment()
    {
        return Payment::where('status',1)->get();
    }
    public function getShipping()
    {
        return Shipping::where('status',1)->get();
    }

    public function getCartItem($id)
    {
        echo $id;
    }
}
