<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart as CartModel;
use App\Models\Cart\CartAddress as CartAddress;
use App\Models\Cart\CartItem as CartItem;
use App\Models\Customer\Address as AddressModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Payment;
use App\Models\Shipping;
class Address extends Controller
{
    public function AddressAction($id=null,Request $request)
    {  
        
    try{
        $validator = Validator::make($request->all(), [
            "billing.address" => "required",
            "billing.area" => "required",
            "billing.city" => "required",
            "billing.state" => "required",
            "billing.zipcode" => "required",
            "billing.country" => "required",
            
            'payment'=>"required",
            'shippingMethod'=>"required",
           
        ]);
        
        if ($validator->fails()) {
            // return response()->json(['success'=>'Added new records.']);
            return response()->json(['error'=>$validator->errors()->all()]);
        }
         $customerId = SESSION::get('customerId');
        $sessioncartId = SESSION::get('cartId');
        $cartBillingAddressData = $request->get('billing');
        $cartShippingAddressData = $request->get('shipping');
        // print_r($cartBillingAddressData);
        // print_r($cartShippingAddressData);
        // die;


       if($request->quantityCart)
       {
            print_r($request->quantityCart);
            foreach($request->quantityCart as $cartItem =>$values)
            {
              $cartItem = CartItem::find($cartItem);
              $cartItemId = $cartItem->id;
              $cartItem->quantity = $values;
            $cartItem->save();
            }   
           
            // $cartItem = CartItem::find($cartItemId);

            //     foreach ($values as $key => $value) {
            //         $cartItem->$key = $value;
            //     }

            //     $cartItem->save();
            // }
       }

        // print_r($cartShippingAddressData);
        
        $cartBillingAddress = CartAddress::where([['cartId',$sessioncartId],['addressType','billing']])->first();
        $addressCustomer = AddressModel::where([['customerId', $customerId], ['addressType', 'billing']])->first();
        
        if(!$cartBillingAddress)
        {
            
            $cartBillingAddress = new CartAddress;
        }
        $cartBillingAddress->addressId = $addressCustomer->id;
        if(!$addressCustomer)
        {
            $cartBillingAddress->addressId =null;
        }
        $cartBillingAddress->cartId = $sessioncartId;
        $cartBillingAddress->address = $cartBillingAddressData['address'];
        $cartBillingAddress->area = $cartBillingAddressData['area'];
        $cartBillingAddress->city = $cartBillingAddressData['city'];
        $cartBillingAddress->state = $cartBillingAddressData['state'];     
        $cartBillingAddress->zipcode = $cartBillingAddressData['zipcode'];
        $cartBillingAddress->country = $cartBillingAddressData['country'];
        $cartBillingAddress->addressType = 'billing';
        $cartBillingAddress->sameAsBilling = 1;
        $cartBillingAddress->save();
     

        if(array_key_exists('sameAsBilling',$cartShippingAddressData))
        {
            
            $cartShippingAddress = CartAddress::where([['cartId',$sessioncartId],['addressType','shipping']])->first();
            $addressCustomer = AddressModel::where([['customerId', $customerId], ['addressType', 'shipping']])->first();
            
            if(!$cartShippingAddress)
            {
                $cartShippingAddress = new CartAddress;
            }
            $cartShippingAddress->addressId = null;
            if($addressCustomer)
            {
                $cartShippingAddress->addressId = $addressCustomer->id;
            }
            $cartShippingAddress->cartId = $sessioncartId;
            $cartShippingAddress->address = $cartBillingAddressData['address'];
            $cartShippingAddress->area = $cartBillingAddressData['area'];
            $cartShippingAddress->city = $cartBillingAddressData['city'];
            $cartShippingAddress->state = $cartBillingAddressData['state'];
            $cartShippingAddress->zipcode = $cartBillingAddressData['zipcode'];
            $cartShippingAddress->country = $cartBillingAddressData['country'];
            $cartShippingAddress->addressType = 'shipping';
            $cartShippingAddress['sameAsBilling'] = 1;
            $cartShippingAddress->save();
            
        }
        else
        {
            
            $cartShippingAddress = CartAddress::where([['cartId',$sessioncartId],['addressType','shipping']])->first();
            $addressCustomer = AddressModel::where([['customerId', $customerId], ['addressType', 'shipping']])->first();
            if(!$cartShippingAddress)
            {
                $cartShippingAddress = new CartAddress;
            }
            $cartShippingAddress->addressId = null;
            if($addressCustomer)
            {
                $cartShippingAddress->addressId = $addressCustomer->id;
            }
            $cartShippingAddress->cartId = $sessioncartId;
            $cartShippingAddress->address = $cartShippingAddressData['address'];
            $cartShippingAddress->area = $cartShippingAddressData['area'];
            $cartShippingAddress->city = $cartShippingAddressData['city'];
            $cartShippingAddress->state = $cartShippingAddressData['state'];
            $cartShippingAddress->zipcode = $cartShippingAddressData['zipcode'];
            $cartShippingAddress->country = $cartShippingAddressData['country'];
            $cartShippingAddress->addressType = 'shipping';
            $cartShippingAddress->sameAsBilling = 1;
            $cartShippingAddress->save();

        }
     
        if(array_key_exists('saveInAddressBook',$cartBillingAddressData))
        {
            $customerBillingAddress = AddressModel::where([['addressType','billing'],['customerId',$customerId]])->first();
            if (!$customerBillingAddress)
            {
                $customerBillingAddress = new AddressModel;
            }
          
            $customerBillingAddress->customerId = $customerId;
            $customerBillingAddress->address = $cartBillingAddressData['address'];
            $customerBillingAddress->area = $cartBillingAddressData['area'];
            $customerBillingAddress->city = $cartBillingAddressData['city'];
            $customerBillingAddress->state = $cartBillingAddressData['state'];
            $customerBillingAddress->country = $cartBillingAddressData['country'];
            $customerBillingAddress->zipcode = $cartBillingAddressData['zipcode'];
            $customerBillingAddress->addressType = 'billing';
            $customerBillingAddress->save();

            $cartBillingAddress = CartAddress::where([['cartId',$sessioncartId],['addressType','billing']])->first();
            $cartBillingAddress->addressId = $customerBillingAddress->id;
            $cartBillingAddress->save();
        }

        if(array_key_exists('saveInAddressBook',$cartShippingAddressData))
        {
            $customerShippingAddress = AddressModel::where([['addressType','shipping'],['customerId',$customerId]])->first();
            if (!$customerShippingAddress)
            {
                $customerShippingAddress = new AddressModel;
            }

            $customerShippingAddress->customerId = $customerId;
            $customerShippingAddress->address = $cartShippingAddressData['address'];
            $customerShippingAddress->area = $cartShippingAddressData['area'];
            $customerShippingAddress->city = $cartShippingAddressData['city'];
            $customerShippingAddress->state = $cartShippingAddressData['state'];
            $customerShippingAddress->country = $cartShippingAddressData['country'];
            $customerShippingAddress->zipcode = $cartShippingAddressData['zipcode'];
            $customerShippingAddress->addressType = 'shipping';
            $customerShippingAddress->save();
            $cartShippingAddress = CartAddress::where([['cartId',$sessioncartId],['addressType','shipping']])->first();
            $cartShippingAddress->addressId = $customerShippingAddress->id;
            $cartShippingAddress->save();
        }
            $shippingMethod= $request->shippingMethod;
            $payment = $request->payment;
            $shipping = Shipping::where('id',$shippingMethod)->first();
            $shippingamount = $shipping->amount;

            $cartupdate = CartModel::where('id',$sessioncartId)->first();
            $cartupdate->paymentId = $payment;
            $cartupdate->shippingId = $shippingMethod;
            $cartupdate->shippingAmount = $shippingamount;
            $cartupdate->save();
            return \redirect('cart/'.$sessioncartId)->with('AddressUpdated','Cart Address Updated');
    }catch (\Exception $e) {
        echo  $e->getMessage();
     //    die;
         //     die;
       
     }
 }
}
