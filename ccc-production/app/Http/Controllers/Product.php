<?php

namespace App\Http\Controllers;

use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Customer;
Use Carbon\Carbon;
use App\Models\Product\Media;
use Facade\FlareClient\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use Yajra\DataTables\Facades\DataTables;

class Product extends Controller
{
    protected $products = [];
    protected $medias = [];
    protected $categories=[];
    protected $productModel = null;
    protected $categoryOptions = [];
    public $id = null;


    public function getProductModel()
    {
        if (!$this->productModel) {
            $this->setProductModel();
        }
        return $this->productModel;
    }

    public function setProductModel($productModel = null)
    {
        if (!$this->productModel) {
            $productModel = new ProductModel();
        }

        $this->productModel = $productModel;
    }

    public function gridAction($orderBy = null, $orderDirection = null)
    {

        $page = 2;
        if (Session::has('page')) {
            $page = Session::get('page');
        } else {
            Session::put('page', $page);
        }
        $products = new ProductModel;
        $this->setProducts($products->fetchAll());
        $id = trim(request()->get('id'));
        if(Session::get('products'))
       {
        return  view('product.product',['products'=>Session::get('products'),'controller'=>$this]);
       }
       elseif (($orderBy && $orderDirection)) {
        $controller = $this;
        $orderBy ="id";
        $orderDirection="desc";
        $products = ProductModel::orderBy($orderBy, $orderDirection)->paginate($page);
        return view('product.product', \compact('controller', 'products'));
       }
       else
       {
        session::forget('searchid');
        session::forget('searchsSku');
        session::forget('searchName');
        session::forget('searchPrice');
        session::forget('createdDate');
        $pagination = ProductModel::sortable()->paginate($page);
       return  view('product.product',['products'=>$pagination,'controller'=>$this]);
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
       $products = new ProductModel;

        $id = trim($request->get('id'));
        $sku = trim($request->get('sku'));
        $name = trim($request->get('name'));
        $price = trim($request->get('price'));
        $createdDate = $request->input('createdDate');
        $date = Carbon::now();
        $date = $date->toDateString();
        if($createdDate)
        {
            session(['createdDate' =>$createdDate]);
        session::save();
        $products = ProductModel::where('created_at','>=',$createdDate)->
        where('created_at','<=',$date)->orderBy('id')->sortable()->paginate($page);
        return redirect('/productGrid')->with('products',$products);
        }

        if($id || $sku || $name || $price)
        {
            session(['searchid' =>$id,'searchsSku'=>$sku,'searchName'=>$name,'searchPrice'=>$price]);
        session::save();
        $products = ProductModel::where([['id','LIKE',"%{$id}%"],['sku','LIKE',"%{$sku}%"],['name','LIKE',"%{$name}%"],['price','LIKE',"%{$price}%"]])->orderBy('id')->sortable()->paginate($page);
        return redirect('/productGrid')->with('products',$products);
        }

        if($id == null || $sku == null || $name == null || $price == null)
        {
            return redirect('/productGrid');
        }
       if($id)
       {
        session(['searchid' =>$id]);
        session::save();
        $products = ProductModel::where('id','LIKE',"%{$id}%")->orderBy('id')->sortable()->paginate($page);
        return redirect('/productGrid')->with('products',$products);
       }
       if($sku)
       {
        session(['searchsSku' =>$sku]);
        session::save();
        $products = ProductModel::where('sku','LIKE',"%{$sku}%")->orderBy('id')->sortable()->paginate($page);
        return redirect('/productGrid')->with('products',$products);
       }
       if($name)
       {
        session(['searchName' =>$name]);
        session::save();
        $products = ProductModel::where('name','LIKE',"%{$name}%")->orderBy('id')->sortable()->paginate($page);
        return redirect('/productGrid')->with('products',$products);
       }
       if($price)
       {
        session(['searchPrice' =>$price]);
        session::save();
        $products = ProductModel::where('price','LIKE',"%{$price}%")->orderBy('id')->sortable()->paginate($page);
        return redirect('/productGrid')->with('products',$products);
       }
    }


    public function formAction($id = null,Request $request)
    {
        try{

        if (!$id)
        {
           return view('product.tabs.form',['product'=> new ProductModel(),'controller'=>$this]);

        }
        else
        {

            $product = new ProductModel;
            $product = $product->load($id);

            return view('product.tabs.form',['product'=> $product,'controller'=>$this]);

        }
    }
    catch (\Exception $e) {
        echo  $e->getMessage();
     }
    }

    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
             $page = 2;
            if (Session::has('page')) {
                $page = Session::get('page');
            } else {
                Session::put('page', $page);
            }
            if(Session::get('searchsSku'))
            {
               $sku = Session::get('searchsSku');
               session(['searchsSku' =>$sku]);
               session::save();
               $products = ProductModel::where('sku','LIKE',"%{$sku}%")->orderBy('id')->sortable()->paginate($page);
               return redirect('/productGrid')->with('products',$products);
            }
            elseif(Session::get('searchName'))
            {
                $name= Session::get('searchName');
             session(['searchName' =>$name]);
             session::save();
             $products = ProductModel::where('name','LIKE',"%{$name}%")->orderBy('id')->sortable()->paginate($page);
             return redirect('/productGrid')->with('products',$products);
            }
            elseif(Session::get('searchPrice'))
            {
                $price= Session::get('searchPrice');
             session(['searchPrice' =>$price]);
             session::save();
             $products = ProductModel::where('price','LIKE',"%{$price}%")->orderBy('id')->sortable()->paginate($page);
             return redirect('/productGrid')->with('products',$products);
            }
            else
            {

                $pagination =  ProductModel::paginate($page);
                return view('product.product',['products'=>$pagination,'controller'=>$this]);
            }
        }
    }


    public function saveAction($id = null,Request $request)
    {

        try{

            $validator = Validator::make($request->all(), [
                "product.sku" => "required|unique:products,sku,$id",
                "product.name" => "required",
                "product.price" => "required",
                "product.discount" => "required",
                "product.quantity" => "required",
                "product.status" => "required",
                "product.description" => "required",
                "product.category_id" => "required",
            ],[
                "product.sku.required" =>"The product Sku Field is required.",
                "product.sku.unique" =>"The product Sku Field should be unique.",
                "product.name.required" => "The product name Field is required.",
                "product.slug.required" =>"The product slug Field is required.",
                "product.slug.unique" =>"The product slug Field should be unique.",
                "product.price.required" => "The product price Field is required.",
                "product.discount.required" =>"The product discount Field is required.",
                "product.quantity.required" => "The product quantity Field is required.",
                "product.status.required" =>"The product status Field is required.",
                "product.description.required" => "The product description Field is required.",
                "product.category_id.required" =>"The product category_id Field is required.",
            ]);


            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $productValue = $request->get('product');
            $productValue['name'] =str_replace(" ", "-", $productValue['slug']);
             if(trim($productValue['name']) !== trim($productValue['slug']))
             {
                return redirect()->back()->with('error', 'Product Slug does not match with Product Name!!');
             }
             else
             {
                $slug = ProductModel::pluck('slug')->toArray();
                $product = $this->getProductModel();
                $productValue = $request->get('product');
                if (in_array($productValue['slug'], $slug)) {
                    // $productValue['slug'] .= "-" . uniqid();
                    echo 'in';

                    if($productValue['slug'] == null)
                    {
                        $productValue['slug'] = $productValue['name'];
                    }
                    $productValue['slug'] =str_replace(" ", "-", $productValue['name']);
                    $productValue['slug'] = preg_replace('/[^A-Za-z0-9]/', '-', $productValue['name']);
                    $productValue['slug']=preg_replace('/-+/', '-', $productValue['slug']);
                    $count = 0;
                    while( in_array( ($productValue['slug'] . '-' . ++$count ), $slug) );

                    $productValue['slug'] = $productValue['slug'] . '-' . $count;
                    echo $productValue['slug'];
                     $formData = $request->get('product');
                date_default_timezone_set('Asia/Kolkata');
                $formData['slug'] = strtolower($productValue['slug']);

                if ($id) {
                    $formData['id'] = $id;
                    $formData['updated_at'] = date('Y-m-d h:i:s');
                } else {
                    $formData['created_at'] = date('Y-m-d h:i:s');
                }


                if ($product->saveData($formData)) {
                    // Session::put('productSave', 'Product Saved successfully!!!');
                    return redirect('/productGrid')->with('productSaves', 'Product Saved successfully!!!');
                }

                }

                $productValue['name'];
                $productValue['slug'] =str_replace(" ", "-", $productValue['name']);
                $productValue['slug'] = preg_replace('/[^A-Za-z0-9]/', '-', $productValue['name']);
                $productValue['slug']=preg_replace('/-+/', '-', $productValue['slug']);
               $formData = $request->get('product');
                date_default_timezone_set('Asia/Kolkata');
                $formData['slug'] = strtolower($productValue['slug']);

                if ($id) {
                    $formData['id'] = $id;
                    $formData['updated_at'] = date('Y-m-d h:i:s');
                } else {
                    $formData['created_at'] = date('Y-m-d h:i:s');
                }


                if ($product->saveData($formData)) {
                    // Session::put('productSave', 'Product Saved successfully!!!');
                    return redirect('/productGrid')->with('productSaves', 'Product Saved successfully!!!');
                }
             }
        }

        catch (\Exception $e) {
                   echo  $e->getMessage();
          }


    }



    public function deleteAction($id)
    {
         $product = $this->getProductModel();
        if (!$product->deleteData([$id])) {
            return redirect('/product')->with('error', 'ERROR WHILE DELETING');
        }
        return redirect('/productGrid')->with('productDelete', 'Product Deleted successfully!!!');;
    }

    public function getCategoryOptions($id = null)
    {
        $category = new CategoryModel();

        return $category->fetchAll()->getCategories();
    }

    public function getCategoryName($id)
    {

        $categoryModel = new CategoryModel();
        $categoryName =  $categoryModel->load($id);
        $categoryNamefind = CategoryModel::find($id);

    //     $parent = CategoryModel::where('id', $categoryName->getCategories()->parentId)->get();
    //     $parentCat =  $categoryModel->load($id);
    //     $child = $categoryNamefind->childs;
    //    if (count($child)) {
    //        echo 123;
    //         if (count($parentCat)) {
    //             foreach ($child as $value) {
    //                 echo $value->parentId = $parentCat[0]->id;

    //             }
    //         }
    //     }

        // if (count($parent)) {

        //     echo $parentCat->getCategories()->name;
        // }

        if(!$categoryNamefind)
        {
            echo 'category not found!!!';
        }
        else{
            // return $categoryName->getCategories()->name;
        }
    }


    public function getCategories()
    {
        return $this->categories;
    }

    public function getProducts()
    {
        if(!$this->products){
            return new ProductModel();
        }
        return $this->products;
    }


    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    public function getMedias()
    {
        return $this->medias;
    }

    public function setMedias($medias)
    {
        $this->medias = $medias;
        return $this;
    }

    public function mediaAction($id)
    {
        $this->id = $id;

        if (!$id) {
           return view('product.tabs.media')->with('product', $this);


        } else {

            $media = new Media;

            $media = $media->fetchAll("select * from media where product_id=$id");


            if ($media->getMedias()) {
                $this->setMedias($media->getMedias());
            }

           return view('product.tabs.media')->with('product', $this);
        }
    }

    public function productStatusAction($id, Request $request)
    {
        $product = ProductModel::find($id);
        if ($product->status == 0) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }
        $product->save();
        return redirect('/productGrid')->with('productStatus', 'Product Status Changed successfully!!!');
    }


    public function setPageAction(Request $request)
    {
        Session::put('page', $request->recordPerPage);
        $page = $request->recordPerPage;
       if ($request->page == 'customerGrid') {
        if(Session::get('searchsSku'))
        {
           $sku = Session::get('searchsSku');
           session(['searchsSku' =>$sku]);
           session::save();
           $customerAddress = Customer::where('firstname','LIKE',"%{$sku}%")->orderBy('id')->sortable()->paginate($page);
           return redirect('/productGrid')->with('customerAddress',$customerAddress);
        }
        elseif(Session::get('searchName'))
        {
            $name= Session::get('searchName');
         session(['searchName' =>$name]);
         session::save();
         $customerAddress = Customer::where('email','LIKE',"%{$name}%")->orderBy('id')->sortable()->paginate($page);
         return redirect('/productGrid')->with('customerAddress',$customerAddress);
        }
        elseif(Session::get('searchPrice'))
        {
            $price= Session::get('searchPrice');
         session(['searchPrice' =>$price]);
         session::save();
         $customerAddress = Customer::where('area','LIKE',"%{$price}%")->orderBy('id')->sortable()->paginate($page);
         return redirect('/productGrid')->with('customerAddress',$customerAddress);
        }
        else
        {
            return redirect('/productGrid');
        }
        }
        elseif($request->page == 'manageOrder'){
            return redirect('/manageOrder');
        }
        elseif($request->page == 'payment'){
            return redirect('/payment');
        }elseif($request->page == 'shipping'){
            return redirect('/shipment');
        }
        else {

            if(Session::get('searchsSku'))
            {
               $sku = Session::get('searchsSku');
               session(['searchsSku' =>$sku]);
               session::save();
               $products = ProductModel::where('sku','LIKE',"%{$sku}%")->orderBy('id')->sortable()->paginate($page);
               return redirect('/productGrid')->with('products',$products);
            }
            elseif(Session::get('searchName'))
            {
                $name= Session::get('searchName');
             session(['searchName' =>$name]);
             session::save();
             $products = ProductModel::where('name','LIKE',"%{$name}%")->orderBy('id')->sortable()->paginate($page);
             return redirect('/productGrid')->with('products',$products);
            }
            elseif(Session::get('searchPrice'))
            {
                $price= Session::get('searchPrice');
             session(['searchPrice' =>$price]);
             session::save();
             $products = ProductModel::where('price','LIKE',"%{$price}%")->orderBy('id')->sortable()->paginate($page);
             return redirect('/productGrid')->with('products',$products);
            }
            else
            {
                return redirect('/productGrid');
            }
        }
    }

    public function fileImport(Request $request)
    {
        try{
            if($request->file('file') == null)
            {
            echo 1;
                $validator  = Validator::make($request->all(),[
                    'file' =>'required',
                ]);
                if($validator->fails())
                {
                    return response()->json(['error' => $validator->errors()->all()]);
                }
                die;
            }
         // if($request->file('file') == null)
         //    {
         //    return redirect('/product')->with('productImport', 'File is empty!!!');
         //        die;
         //    }

        Excel::import(new ProductsImport, $request->file('file')->store('import'));
        // (new ProductsImport)->import($request->file('file'));
        return redirect('/productGrid')->with('productImport', 'File imported successfully!!!');

        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function fileExport()
    {
        return Excel::download(new ProductsExport,'product.csv');
    }

    // public function fileImportExport()
    // {
    //     return view('file.import');
    // }
    public function getColumns()
    {
     return
     [
         'id' => [
             'label' => 'ID',
             'field' => 'id',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],
         'sku' => [
             'label' => 'SKU',
             'field' => 'sku',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],
         'name' => [
             'label' => 'NAME',
             'field' => 'name',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],
         'price' => [
             'label' => 'PRICE',
             'field' => 'price',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],
         'discount' => [
             'label' => 'DISCOUNT (%)',
             'field' => 'discount',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],
         'quantity' => [
             'label' => 'QUANTITY',
             'field' => 'quantity',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],
         'status' => [
             'label' => 'STATUS',
             'field' => 'status',
             'class_asc' => 'lnr lnr-chevron-up',
             'class_desc' => 'lnr lnr-chevron-down'
         ],

     ];
    }



}
