<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer as CustomerModel;

class Customer extends Controller
{
    protected $customer=[];
    public function gridAction() 
    {
        $customer  = CustomerModel::all();
        $view = view('customer.grid',['customers'=>$customer])->render();
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
       $view = view('customer.tabs.personalform',['customer'=>$customer])->render();
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

    public function customerStatusAction()
    {

    }

    public  function deleteAction()
    {
      
    }
}
