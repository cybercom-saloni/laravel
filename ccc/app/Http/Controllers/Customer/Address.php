<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Address as AddressModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;

class Address extends Controller
{
    public function formAction(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "billing.address" => "required",
                "billing.area" => "required",
                "billing.city" => "required",
                "billing.state" => "required",
                "billing.zipcode" => "required",
                "billing.country" => "required",
            ]);
            if ($validator->fails()) {
                Session::put('billingError',$validator->errors());
            }
           
        $customerId = $request->id;
        $billingAddress = AddressModel::where([['addressType','billing'],['customerId',$customerId]])->first();
        $shippingAddress = AddressModel::where([['addressType','shipping'],['customerId',$customerId]])->first();
        
      
        if(!$billingAddress)
        {
            $validator = Validator::make($request->all(), [
                "billing.address" => "required",
                "billing.area" => "required",
                "billing.city" => "required",
                "billing.state" => "required",
                "billing.zipcode" => "required",
                "billing.country" => "required",
            ]);
            if ($validator->fails()) {
                Session::put('billingError',$validator->errors());
            }
        }else
        {
            $validator = Validator::make($request->all(), [
                "billing.address" => "required",
                "billing.area" => "required",
                "billing.city" => "required",
                "billing.state" => "required",
                "billing.zipcode" => "required",
                "billing.country" => "required",
            ]);
            if ($validator->fails()) {
                Session::put('billingError',$validator->errors());
            }
        }
        $view = view('customer.tabs.addressform',['billing'=>$billingAddress,'shipping'=>$shippingAddress])->render();
        
            $response=[
                        'element'=>[
                            [
                                'selector' => '#content',
                                'html' => $view
                            ]
                        ]
                    ];
            header('content-type:application/json');
            echo json_encode($response);
            die();
        }catch(Exception $e)
        {
            echo  $e->getMessage();
        }
    }    

    

    public function saveAction($id,Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "billing.address" => "required",
                "billing.area" => "required",
                "billing.city" => "required",
                "billing.state" => "required",
                "billing.zipcode" => "required",
                "billing.country" => "required",
            ]);
            if ($validator->fails()) {
                Session::put('billingError',$validator->errors());
                throw new Exception($validator->errors());
            }

            $billingAddress = AddressModel::where([['customerId',$id],['addressType','billing']])->first();
            if(!$billingAddress)
            {
                $billingAddress = new AddressModel;
                $billingAddress->customerId = $id;
                $billingAddress->addressType = 'billing';
            }
            // $billing = $request->billing;
            foreach ($request->billing as $key => $value) {
                $billingAddress->$key = $value;
            }
            $billingAddress->save();
            $shippingAddress = AddressModel::where([['customerId',$id],['addressType','shipping']])->first();
            if(!$shippingAddress)
            {
                $shippingAddress = new AddressModel;
                $shippingAddress->customerId= $id;
                $shippingAddress->addressType = 'shipping';
            }
            foreach($request->shipping as $key => $value)
            {
                $shippingAddress->$key = $value;
            }
            $shippingAddress->save();
            
            return redirect('customerGrid')->with('custAddressSave','Customer Address Saved!!!');
        }catch (\Exception $e) {
            echo  $e->getMessage();
         //    die;
             
             return redirect()->back()->withInput();
         //     die;
           
         }
    }

    public function AddressAction()
    {
        echo 'in Address';
    }
}
