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
        $pagination = PaymentModel::paginate(2);
        return view('payment.grid',['payments'=>$pagination,'controller'=>$this]);

    }

    public function formAction($id=null,Request $request)
    {
            if(!$id)
                {
                   return view('payment.form');

                }
                else
                {
                    $customer = PaymentModel::find($id);
                      return  view('payment.form',['customer'=>$customer]);
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

    public function paymentSortingAction(Request $request)
    {
       if($request->ajax())
       {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sort_type');
            $payments = PaymentModel::orderBy($sort_by,$sort_type)->get();
            return view('payment.grid',compact('payments'));
       }
    }
}
