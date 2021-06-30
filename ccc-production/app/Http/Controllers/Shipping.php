<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shipping as ShippingModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class Shipping extends Controller
{
    public function tryAction()
    {
        echo 12345;
    }
    public function gridAction()
    {
        $page = 2;
        if (Session::has('page')) {
            $page = Session::get('page');
        } else {
            Session::put('page', $page);
        }
        $pagination = ShippingModel::paginate($page);
        return \view('shipping.grid',['shippings'=>$pagination,'controller'=>$this]);
    }

    public function formAction($id=null,Request $request)
    {
        try{


                if(!$id)
                {
                    return view('shipping.form');

                }else
                {
            $customer = ShippingModel::find($id);
            return view('shipping.form',['customer'=>$customer]);
            }
        } catch (\Exception $e) {
            echo  $e->getMessage();
        }
    }


    public  function saveAction($id=null,Request $request)
    {
    try{

        $validator = Validator::make($request->all(), [
            "shipping.name" => "required",
            "shipping.code" => "required|unique:shippings,code,$id",
            "shipping.amount" => "required",
            "shipping.description" => "required",
            "shipping.status" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $customerData = $request->shipping;
        ShippingModel::updateOrInsert(['id'=>$id],$customerData);

        return redirect('shipment')->with('shippingSave','shipping Saved!!!');
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

        $ShippingModel = ShippingModel::find($id);
        $ShippingModel->delete();
        return redirect('shipment')->with('shippingDelete','shipping Deleted!!!');
    }

    public function StatusAction($id,Request $request)
    {
        $ShippingModel = ShippingModel::find($id);
        if($ShippingModel->status == 1)
        {
            $ShippingModel->status = 0;
        }
        else
        {
            $ShippingModel->status = 1;
        }
        $ShippingModel->save();
        return redirect('shipment')->with('shippingstatus','status Changed!!!');
    }
}
