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
            if(!$request->get('namesearch'))
            {
                
                $salesmanName = SalesmanModel::orderBy('name')->get();
               
            }
            else
            {
                $name =trim($request->get('namesearch'));
                $salesmanName = SalesmanModel::where('name','LIKE',"%{$name}%")->orderBy('name')->get();
            }

            if($id)
            {
                // echo $id;
                $salesman = DB::select("SELECT p.id,s.id as sid,s.salesmanPrice,p.sku,p.price,s.salesmanDiscount
                FROM products  as p
                LEFT JOIN salesman_products as s
                ON s.product_id = p.id
                AND s.salesman_id=$id");
                
                $salesId=$id;
                $view = view('salesman.grid',\compact('salesmanName','salesman','salesId'))->render();
            }
           else
           {
               $view = view('salesman.grid',\compact('salesmanName'))->render();

           }
            $response = [
                'element'=>[
                     'selector'=>'#content',
                     'html'=>$view,
                ]
                ];
             header('content-type:application/json');
             echo json_encode($response);
             die();
            // print_r($find);
            
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    public function SalesmanAddNewProductAction($id=null,Request $request){
        // echo 123;
        echo $id;
        
      $name =$request->get('addsalesman');
      $product = new ProductModel;
    //   print_r($name);
  
        echo $request->id;
      foreach ($name as $key => $value) {
          $product->setAttribute($key,$value);
      }
    //   print_r($product);
      $product->save();
      $salesman = DB::select("SELECT s.id,s.salesmanPrice,p.sku,p.price,s.salesmanDiscount
      FROM products  as p
      LEFT JOIN salesman_products as s
      ON s.product_id = p.id
      AND s.salesman_id=$id");
      return \redirect('salesmanGrid/'.$id)->with('successAdd','Product Added!!!')->with('salesmanId',$salesman)->with('salesId',$id)->with('selectedId',$id);
    }



    public function showPriceAction($id=null,Request $request){
        $salesman = DB::select("SELECT p.id,s.id as sid,s.salesmanPrice,p.sku,p.price,s.salesmanDiscount
                             FROM products  as p
                             LEFT JOIN salesman_products as s
                             ON s.product_id = p.id
                             AND s.salesman_id=$id");
        return redirect('/salesmanGrid')->with('salesmanId',$salesman)->with('salesId',$id)->with('selectedId',$id);
    }
    public function showPriceAction2($id=null,Request $request){
        $salesman = DB::select("SELECT p.id,s.id as sid,s.salesmanPrice,p.sku,p.price,s.salesmanDiscount
                             FROM products  as p
                             LEFT JOIN salesman_products as s
                             ON s.product_id = p.id
                             AND s.salesman_id=$id");
        return redirect('/salesmanGrid')->with('salesmanId',$salesman)->with('salesId',$id)->with('selectedId',$id)->with('salesmanAddedProduct','Salesman Product Price Updated!!!');
    }
 
    public function updatePriceAction($id=null,Request $request)
    {
      $salesmanData = [];
       echo $id;
       echo  "<pre>";
       $updateSalesmanPrice = $request->get('updateSalesmanPrice');
       
       $updateSalesmanDiscount=$request->get('updateSalesmanDiscount');
        //   print_r($updateSalesmanDiscount);
        $salesman = DB::select("SELECT s.id,s.salesmanPrice,p.sku,p.price,s.salesmanDiscount
        FROM products  as p
        LEFT JOIN  salesman_products as s
        ON s.product_id = p.id
        AND s.salesman_id=$id");
       
       
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
                if($salesmanData)
                {
                    $productPrice = $salesmanData[0]->price;
                    $salesmanPriceCost = $price;
                    if($productPrice <= $salesmanPriceCost)
                    {
                        // echo  $productId;
                    $affectedRows = SalesmanProduct::where("id", $salesmanData[0]->id)->update(["salesmanPrice" => $salesmanPriceCost]);
                    }
                    else
                    {
                        echo  $productId.'  '.$salesmanPriceCost.'out'.' ';
                    }
                }
                else
                {
                    
                    $productData = DB::select("SELECT p.price,p.id
                FROM products  as p
                WHERE id = $productId");
                $productPrice=$productData[0]->price;
                // print_r($productPrice);
                    $salesmanPriceCost = $price;

                    if($productPrice <= $salesmanPriceCost)
                    {
                    SalesmanProduct::insert([
                                            'salesman_id' => $id, 
                                            'product_id' => $productId,
                                            'salesmanPrice' => $price
                                        ]);
                                    }
                                    else
                                    {
                                        echo 'out';
                                    }
                                   
                }

            }
            
        }
        
        if($updateSalesmanDiscount)
        {
            foreach($updateSalesmanDiscount as $productId =>$price)
            {
                
                $salesmanProduct = DB::select("SELECT * FROM salesman_products WHERE product_id = $productId AND salesman_id =$id");
                if($salesmanProduct)
                {
                    
                    foreach($salesmanProduct as $key =>$value)
                    {
                     $affectedRows = SalesmanProduct::where("id", $value->id)->update(["salesmanDiscount" => $price]);
                    }
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
    //   return \redirect('SalesmanPrice/salesman/'.$id)->with('salesmanAddedProduct','Salesman Product Price Updated!!!')->with('selectedId',$id);
    }

    public function addPriceAction($id=null,Request $request)
    {
       $salesmanPrice =$request->get('addsalesman');
    //    print_r($salesmanPrice);
    //    echo $id;
    }

    public function addAction($id=null,Request $request)
    {
       try{
            $validator = Validator::make($request->all(), [
                "salesman.name" => "required|unique:salesmen,name",
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
            return redirect('/salesmanGrid')->with('salesmanDelete','Salesman Deleted')->with('salesId',$id);
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }


    public function searchSalesmanAction(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "namesearch" => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            $name =trim($request->get('namesearch'));
            $find = SalesmanModel::where('name','LIKE',"%{$name}%")->orderBy('name')->get();
           
            // print_r($find);
            
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}

