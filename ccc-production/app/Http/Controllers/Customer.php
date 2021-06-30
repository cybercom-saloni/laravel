<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer as CustomerModel;
use App\Models\Customer\Address as AddressModel;
use Illuminate\Support\Facades\Crypt;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Exception;

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
        if(Session::get('customerAddress'))
        {
            return  view('customer.grid',['pagination'=>$pagination,'customerAddress'=>Session::get('customerAddress')]);
        }
        else
        {
        // $customerAddress  = CustomerModel::leftJoin('addresses','customers.id','=','addresses.customerId')
        //  ->select('customers.id','customers.firstname','customers.lastname','customers.email','customers.contactno','addresses.address','addresses.area','addresses.city','addresses.state','addresses.zipcode','addresses.country','addresses.addressType','customers.status')->sortable()->paginate($page);

        //  $customerAddress=DB::select("SELECT customers.id,customers.firstname,customers.lastname,customers.email,customers.contactno,addresses.address,addresses.area,addresses.city,addresses.state,addresses.zipcode,addresses.country,addresses.addressType,customers.status
        //                     FROM customers
        //                       LEFT JOIN addresses ON customers.id = addresses.customerId AND addresses.addressType = 'billing'
        //                      ");
        $customerAddress = DB::table('customers')
                                ->select('customers.id','customers.firstname','customers.lastname','customers.email','customers.contactno','addresses.address','addresses.area','addresses.city','addresses.state','addresses.zipcode','addresses.country','addresses.addressType','customers.status')
                                ->leftJoin('addresses' ,function($join)
                                {
                                    $join->on('customers.id','=','addresses.customerId');
                                    // $join->where('addresses.addressType','<>','shipping');
                                    // $join->orWhere( 'addresses.addressType','=','billing');

                                })->paginate($page);
        //         echo "<pre>";
        //         print_r($customerAddress);
        //         die;


        $controller = $this;
    return view('customer.grid',['pagination'=>$pagination,'customerAddress'=>$customerAddress,'controller'=>$controller]);
        }
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

    public function searchIdAction(Request $request)
    {

        $page = 2;
       if (Session::has('page')) {
           $page = Session::get('page');
       } else {
           Session::put('page', $page);
       }
       $customerAddress = new CustomerModel;

        echo $id = trim($request->get('id'));
        echo $sku = trim($request->get('sku'));
        echo $name = trim($request->get('name'));
        echo $price = trim($request->get('price'));
        echo $number = trim($request->get('number'));
        if($id)
        {

         session(['searchid' =>$id]);
         session::save();
          $customerAddress = CustomerModel::where('id','LIKE',"%{$id}%")->orderBy('id')->sortable()->paginate($page);
         return redirect('/customerGrid')->with('customerAddress',$customerAddress);
        }
        if($sku)
       {
        session(['searchsSku' =>$sku]);
        session::save();
        $customerAddress = CustomerModel::where('firstName','LIKE',"%{$sku}%")->orderBy('id')->sortable()->paginate($page);

        return redirect('/customerGrid')->with('customerAddress',$customerAddress);
       }

       if($name)
       {
        session(['searchName' =>$name]);
        session::save();
        $customerAddress = CustomerModel::where('lastname','LIKE',"%{$name}%")->orderBy('id')->sortable()->paginate($page);
        return redirect('/customerGrid')->with('customerAddress',$customerAddress);
       }

       if($price)
       {
        session(['searchPrice' =>$price]);
        session::save();
        $customerAddress = CustomerModel::where('email','LIKE',"%{$price}%")->orderBy('id')->sortable()->paginate($page);
        return redirect('/customerGrid')->with('customerAddress',$customerAddress);
       }
        // die;
        // if($id || $sku || $name || $price ||$number)
        // {
        //     session(['searchid' =>$id,'searchsSku'=>$sku,'searchName'=>$name,'searchPrice'=>$price,'searchNumber'=>$number]);
        // session::save();
        // $customerAddress = CustomerModel::where([['id','LIKE',"%{$id}%"],['sku','LIKE',"%{$sku}%"],['name','LIKE',"%{$name}%"],['price','LIKE',"%{$price}%"]])->orderBy('id')->sortable()->paginate($page);
        // return redirect('/customerGrid')->with('customerAddress',$customerAddress);
        // }

        // if($id == null || $sku == null || $name == null || $price == null ||$number==null)
        // {
        //     return redirect('/customerGrid');
        // }

       die;



    }

    public function formAction($id=null,Request $request)
    {
        try{


                if(!$id)
                {
                   return view('customer.tabs.personalform');

                }else
                {
            $customer = CustomerModel::find($id);
                $password=  Crypt::decryptString($customer->password);
           return  view('customer.tabs.personalform',['customer'=>$customer,'password'=>$password]);

            }
        } catch (\Exception $e) {
            echo  $e->getMessage();
        }
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
        Session::forget('customerId');
        return redirect('customerGrid')->with('custDelete','customer Deleted!!!');
    }

    public  function saveAction($id=null,Request $request)
    {
    try{

        $validator = Validator::make($request->all(), [
            "customer.firstname" => "required",
            "customer.lastname" => "required",
            "customer.email" => "required|email|unique:customers,email,$id",
            "customer.password" => "required",
            "customer.contactno" => "required",
            "customer.status" => "required",
        ]);

        if ($validator->fails()) {
            // return response()->json(['success'=>'Added new records.']);
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $customerData = $request->customer;

        $password =  Crypt::encryptString($customerData['password']);
        $customerData['password'] = $password;


        CustomerModel::updateOrInsert(['id'=>$id],$customerData);
        // $lastRecord = CustomerModel::orderBy('id', 'DESC')->first();
        // $lastRecordId = $lastRecord->id;
        // $billingAddress = AddressModel::where([['customerId',$id],['addressType','billing']])->first();
        // if(!$billingAddress)
        // {
        //     $id = $lastRecordId;
        //     $billingAddress = new AddressModel;

        // }
        // $billingAddress->customerId = $id;
        // $billingAddress->addressType = 'billing';
        // $billingAddress->save();
        // CustomerModel::upsert($customerData,['id'],['firstname','lastname','email','password','contactno','status']);
        return redirect('customerGrid')->with('custSave','customer Saved!!!');
        }
        catch (\Exception $e) {
            echo  $e->getMessage();
            return response()->json(['error'=>$e->getMessage()]);
         //    die;

            //  return redirect()->back()->withInput();
         //     die;

         }


    }
}
