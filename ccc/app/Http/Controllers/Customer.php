<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer as CustomerModel;
use App\Models\Customer\Address as AddressModel;
use Crypt;
use Facade\FlareClient\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Customer extends Controller
{
    protected $customer=[];
    public function gridAction() 
    {
        // $customer  = CustomerModel::all();
        $page = 2;
        if (Session::has('page')) {
            $page = Session::get('page');
        } else {
            Session::put('page', $page);
        }
        $pagination = CustomerModel::paginate($page);
        $customerAddress  = CustomerModel::leftJoin('addresses','customers.id','=','addresses.customerId')
        ->select('customers.id','customers.firstname','customers.lastname','customers.email','customers.contactno','addresses.address','addresses.area','addresses.city','addresses.state','addresses.zipcode','addresses.country','addresses.addressType','customers.status')->paginate($page);
        $customerAddress = CustomerModel::
        $view = view('customer.grid',['customers'=>$pagination,'customerAddress'=>$customerAddress])->render();
        $response = [
            'element' =>[
                [
                    'selector' => '#content',
                    'html' => $view
                ]
            ]
        ];
        header('content-type:application/json');
        echo json_encode($response);
        die();
    }
    public function fetch_data(Request $request)
    {
        echo 1111;
        if($request->ajax())
        {
            $customerAddress = CustomerModel::leftJoin('addresses','customers.id','=','addresses.customerId')
            ->select('customers.id','customers.firstname','customers.lastname','customers.email','customers.contactno','addresses.address','addresses.area','addresses.city','addresses.state','addresses.zipcode','addresses.country','addresses.addressType','customers.status')->paginate(2);
            return  view('customer.grid',['customerAddress'=>$customerAddress])->render();
        }
    }
    

    public function formAction($id=null)
    {
        if(!$id)
        {
            $view =view('customer.tabs.personalform')->render();
            $response = [
                        'element' =>[
                            [
                                'selector' => '#content',
                                'html' => $view
                            ]
                        ]
                    ];
            header('content-type:application/json');
            echo json_encode($response);
            die();
        }
       $customer = CustomerModel::find($id);
        $password=  Crypt::decryptString($customer->password);
       $view = view('customer.tabs.personalform',['customer'=>$customer,'password'=>$password])->render();
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
    }

    public function customerStatusAction($id,Request $request)
    {
        $customerModel = CustomerModel::find($id);
        if($customerModel->status == 1)
        {
            $customerModel->status = 0;
        }
        else
        {
            $customerModel->status = 1;
        }
        $customerModel->save();
        return redirect('customerGrid')->with('custstatus','status Changed!!!');
    }

    public  function deleteAction($id)
    {
        $customerModel = CustomerModel::find($id);
        $customerModel->delete();
        return redirect('customerGrid')->with('custDelete','customer Deleted!!!');
    }

    public  function saveAction($id=null,Request $request)
    {
        
        $customerData = $request->customer;
        // $request->validate([
        //     'customerData[firstname]' => 'required',
        // ]);
        $password =  Crypt::encryptString($customerData['password']);
        $customerData['password'] = $password;
        // date_default_timezone_set('Asia/Kolkata');
        // $customerData['created_at']= date('d-m-Y H:i');
        // print_r($customerData);
        CustomerModel::updateOrInsert(['id'=>$id],$customerData);
        
        // CustomerModel::upsert($customerData,['id'],['firstname','lastname','email','password','contactno','status']);
        return redirect('customerGrid')->with('custSave','customer Saved!!!');
    }
}
