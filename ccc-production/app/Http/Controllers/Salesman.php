<?php
namespace App\Http\Controllers;
use  App\Models\Salesman\SalesmanProduct;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use App\Models\Salesman as SalesmanModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class Salesman extends Controller
{
    public function gridAction($id=null,Request $request)
    {
        try{
            $salesman_id = session('idSales');
            if($request->get('namesearch'))
            {
                $name =trim($request->get('namesearch'));
                session::forget('idSales');
                session(['searchName' =>$name]);
                session::save();
                $salesmanName = SalesmanModel::where('name','LIKE',"%{$name}%")->orderBy('name')->get();
                $idSales = $id;
            }
            else
            {
                if(session('searchName'))
                {

                   $name = session('searchName');
                   $salesmanName = SalesmanModel::where('name','LIKE',"%{$name}%")->orderBy('name')->get();
                }
                else{
                    $salesmanName = SalesmanModel::orderBy('name')->get();
                }

            }
            if($id)
            {
                $salesman = DB::table('products as p')
                                ->select('p.id', 's.id as sid', 's.salesmanPrice','p.sku','p.price','s.salesmanDiscount')
                                ->leftJoin('salesman_products as s',function($join) use($id)
                                {
                                    $join->on('s.product_id','=','p.id');
                                    $join->where('s.salesman_id','=',"$id");
                                })->get();

                $idSales=$id;
                return view('salesman.grid',\compact('salesmanName','salesman','idSales'));

            }
           else
           {
               return view('salesman.grid',\compact('salesmanName'));

           }
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
 public function SalesmanAddNewProductAction($id=null,Request $request){

        $validator = Validator::make($request->all(), [
            "addsalesman.sku" => "required|unique:products,sku",
            "addsalesman.price" => "required"
        ],[
            "addsalesman.sku.required" =>"The product Sku Field is required.",
            "addsalesman.sku.unique" =>"The product Sku Field should be unique.",
            "addsalesman.price.required" => "The product price Field is required."
        ]);
        if ($validator->fails()) {

            return response()->json(['error'=>$validator->errors()->all()]);
        }
      $name =$request->get('addsalesman');

      $product = new ProductModel;
      foreach ($name as $key => $value) {
          $product->setAttribute($key,$value);
      }

      $product->save();
      $salesman = DB::table('products as p')
        ->select('p.id', 's.id as sid', 's.salesmanPrice','p.sku','p.price','s.salesmanDiscount')
        ->leftJoin('salesman_products as s',function($join) use($id)
        {
            $join->on('s.product_id', '=', 'p.id');
            $join->where('s.salesman_id', '=',"$id");
        })->get();
      return \redirect('salesmanGrid/'.$id)->with('successAdd','Product Added!!!')->with('salesmanId',$salesman)->with('idSales',$id)->with('selectedId',$id);
    }



    public function showPriceAction($id=null,Request $request){
        $salesman_id= $id;
        $salesman = DB::table('products as p')
        ->select('p.id', 's.id as sid', 's.salesmanPrice','p.sku','p.price','s.salesmanDiscount')
        ->leftJoin('salesman_products as s',function($join) use($id)
        {
            $join->on('s.product_id', '=', 'p.id');
            $join->where('s.salesman_id', '=',"$id");
        })->get();

        return redirect('/salesmanGrid')->with('salesmanId',$salesman)->with('idSales',$id)->with('selectedId',$id);
    }


   public function updatePriceAction($id=null,Request $request)
    {
      $salesmanData = [];
       $updateSalesmanPrice = $request->get('updateSalesmanPrice');
       $updateSalesmanDiscount=$request->get('updateSalesmanDiscount');
        if($updateSalesmanPrice)
        {
            foreach($updateSalesmanPrice as $productId =>$price)
            {
                $salesmanData = DB::select("SELECT s.id,s.salesmanPrice,p.sku,p.price,s.salesmanDiscount
                FROM products  as p
               INNER JOIN  salesman_products as s
                ON s.product_id = p.id
                AND s.salesman_id=$id
                AND s.product_id = $productId");
                // $salesmanData = DB::table('salesman_products as s')
                //                 ->select('p.id', 's.id as sid', 's.salesmanPrice','p.sku','p.price','s.salesmanDiscount')
                //                 ->leftJoin('products as p' ,function($join) use($id,$productId)
                //                 {
                //                     $join->on('s.product_id','=','p.id');
                //                     $join->where('s.product_id','=',$productId);
                //                     // $join->where('s.salesman_id','=',$id);
                //                 })->get();
                // echo "<pre>";
                // print_r($salesmanData);
                // die;

                if($salesmanData)
                {
                    echo $productPrice = $salesmanData[0]->price;
                    $salesmanPriceCost = $price;
                    if($productPrice <= $salesmanPriceCost)
                    {
                    $affectedRows = SalesmanProduct::where("id", $salesmanData[0]->id)->update(["salesmanPrice" => $salesmanPriceCost]);
                    }
                }
                else
                {
                 $productData= ProductModel::where('id',$productId)->first();
                 $productPrice = $productData->price;
                    $salesmanPriceCost = $price;

                    if($productPrice <= $salesmanPriceCost)
                    {
                    SalesmanProduct::insert([
                                            'salesman_id' => $id,
                                            'product_id' => $productId,
                                            'salesmanPrice' => $price
                                        ]);
                    }

                }

            }

        }
// die;
        if($updateSalesmanDiscount)
        {
            foreach($updateSalesmanDiscount as $productId =>$price)
            {
                  $salesmanProduct= SalesmanProduct::where('product_id',$productId)->where('salesman_id',$id)->first();

                if($salesmanProduct)
                {

                     $affectedRows = SalesmanProduct::where("id", $salesmanProduct->id)->update(["salesmanDiscount" => $price]);
                }
                else
                {

                    SalesmanProduct::insert([
                        'salesman_id' => $id,
                        'product_id' => $productId,
                        'salesmanDiscount' => $price
                      ]);
                }

            }
        }

      return \redirect('SalesmanPrice/salesman/'.$id)->with('salesmanAddedProduct','Salesman Product Price Updated!!!')->with('selectedId',$id);
    }




    public function addAction($id=null,Request $request)
    {
       try{
            $validator = Validator::make($request->all(), [
                "salesman.name" => "required|unique:salesmen,name",
            ],[
                "salesman.name.required" =>"The salesman name Field is required.",
                "salesman.name.unique" =>"The salesman name Field should be unique"
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            $name=$request->get('salesman');

            if(!$name)
            {
                throw new Exception("Name not inserted");
            }
            $salesman = new SalesmanModel;

            foreach ($name as $key => $value) {
                $salesman->setAttribute($key, $value);
            }
            $salesman->save();
            return redirect('/salesmanGrid')->with('NewSalesman',$name['name'].' Added as Salesman!!')->with('selectedId',$id);

       }
       catch(Exception $e)
       {
           echo $e->getMessage();
       }
    }

    public function deleteAction(Request $request)
    {
        try{
            $id= $request->id;
            if(!$id)
            {
                throw new Exception("SalesmanId is not found");

            }
            $salesman = SalesmanModel::find($id);

            if($salesman)
            {
                $salesman->delete($id);
            }
            return redirect('/salesmanGrid')->with('salesmanDelete',$salesman->name.' Salesman Deleted')->with('idSales',$id);
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function showPriceAction2($id=null,Request $request){
        $salesman = DB::table('products as p')
                    ->select('p.id', 's.id as sid', 's.salesmanPrice','p.sku','p.price','s.salesmanDiscount')
                    ->leftJoin('salesman_products as s',function($join) use($id)
                    {
                        $join->on('s.product_id','=','p.id');
                        $join->where('s.salesman_id','=',"$id");
                    })->get();
        return redirect('/salesmanGrid')->with('salesmanId',$salesman)->with('idSales',$id)->with('selectedId',$id)->with('salesmanAddedProduct','Salesman Product Price Updated!!!');
    }



    public function clearAction()
    {
        session::forget('searchName');
        return redirect('/salesmanGrid');
    }


}
