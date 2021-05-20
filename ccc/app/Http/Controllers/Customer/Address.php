<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Address as AddressModel;

class Address extends Controller
{
    public function formAction(Request $request)
    {
        try{
        $customerId = $request->id;
        $billingAddress = AddressModel::where([['addressType','billing'],['customerId',$customerId]])->first();
        $shippingAddress = AddressModel::where([['addressType','shipping'],['customerId',$customerId]])->first();
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

        }
    }    

    // public function saveAction($id,Request $request)
    // { 
    //     $customerId = $request->customerId;
    //     $billingAddressId = AddressModel::where([['addressType','billing'],['customerId',$customerId]])->first();
    //     $billing = $request->get('billing');
    //     $shipping = $request->get('shipping');
    //     // print_r($billing);
    //     // print_r($shipping);
    //      $billing['customerId'] = $customerId;
    //      $shipping['customerId'] = $customerId;
    //      $billing['addressType'] = 'billing';
    //      $shipping['addressType'] = 'shipping';
    //     // AddressModel::updateOrInsert([['customerId',$customerId],['addressType','billing']],$billing);
    //     // AddressModel::upsert($billing,['addressId'],['customerId','address','city','password','contactno','status']);
    //     AddressModel::updateOrInsert(['addressId'=>$billingAddressId],$billing);
    //     // return redirect('customerGrid');
    // }

    public function saveAction($id,Request $request)
    {
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
        return redirect('customerGrid');
    }

    public function AddressAction()
    {
        echo 'in Address';
    }
}
