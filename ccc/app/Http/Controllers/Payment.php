<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment as PaymentModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class Payment extends Controller
{
    public function gridAction()
    {
        $page = 2;
        if (Session::has('page')) {
            $page = Session::get('page');
        } else {
            Session::put('page', $page);
        }
        $pagination = PaymentModel::paginate($page);
        $view = \view('payment.grid',['payments'=>$pagination,'controller'=>$this])->render();
        $response = [
            'element' => [
                [
                    'success' =>'hello',
                    'name' => 'saloni',
                    'selector' =>'#content',
                    'html' =>$view
                ]
            ]
        ];

        header('content-type:application/json');
        echo json_encode($response);
        die();
    }

    public function formAction($id=null,Request $request)
    {
        try{
            
        
                if(!$id)
                {
                    $view =view('payment.form')->render();
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
                }else
                {
            $customer = PaymentModel::find($id);
            $view = view('payment.form',['customer'=>$customer])->render();
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
        } catch (\Exception $e) {
            echo  $e->getMessage();
        }
    }


    public  function saveAction($id=null,Request $request)
    {
    try{
       
        $validator = Validator::make($request->all(), [
            "payment.name" => "required",
            "payment.code" => "required|unique:payments,code,$id",
            "payment.description" => "required",
            "payment.status" => "required",
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $customerData = $request->payment;
        PaymentModel::updateOrInsert(['id'=>$id],$customerData);
       
        return redirect('payment')->with('PaymentSave','Payment Saved!!!');
        }
        catch (\Exception $e) {
            echo  $e->getMessage();
            return response()->json(['error'=>$e->getMessage()]);
         //    die;
             
            //  return redirect()->back()->withInput();
         //     die;
           
         }


    }

    public function deleteAction( $id)
    {
        
        $PaymentModel = PaymentModel::find($id);
        $PaymentModel->delete();
        return redirect('payment')->with('paymentDelete','payment Deleted!!!');
    }

    public function StatusAction($id,Request $request)
    {
        $PaymentModel = PaymentModel::find($id);
        if($PaymentModel->status == 1)
        {
            $PaymentModel->status = 0;
        }
        else
        {
            $PaymentModel->status = 1;
        }
        $PaymentModel->save();
        return redirect('payment')->with('paymentstatus','status Changed!!!');
    }
}
