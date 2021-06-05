<?php

namespace App\Http\Controllers;

use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Product\Media;
use Facade\FlareClient\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
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

    public function testAction()
    {
        $response = [
            'success' =>'hello',
            'name' => 'saloni'
        ];

        header('content-type:application/json');
        echo json_encode($response);
        die();
    }

    public function gridAction()
    {
        
        $page = 2;
        if (Session::has('page')) {
            $page = Session::get('page');
        } else {
            Session::put('page', $page);
        }
        $products = new ProductModel;
        $this->setProducts($products->fetchAll());
        $pagination = ProductModel::paginate($page);
        $view = \view('product.product',['products'=>$pagination,'controller'=>$this])->render();
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
    
    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $pagination =  ProductModel::paginate(2);
            return view('product.product',['products'=>$pagination,'controller'=>$this])->render();
        }
    }
    public function formAction($id = null,Request $request)
    {
        try{
           
        if (!$id)
        {
            $view = \view('product.tabs.form',['product'=> new ProductModel(),'controller'=>$this])->render();
            $response = 
            [
                'element' => [
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
        else
        {
           
            $product = new ProductModel;
            $product = $product->load($id);

            if ($product->getProducts()) {
                $this->setProducts($product->getProducts());
            }
                $view = \view('product.tabs.form',['product'=> $product,'controller'=>$this])->render();
                $response = [
                    'element' => [
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
    }
    catch (\Exception $e) {
        echo  $e->getMessage();
     //    die;
         
        
     //     die;
       
     }
    }

   
    
    // public function saveAction($id = null,Request $request)
    // {
    //     print_r($request->get('product'));
      
    //     try{
    //     // $validator = Validator::make($request->all(), [
    //     //     "product.sku" => "required",
    //     //     "product.name" => "required",
    //     //     "product.price" => "required",
    //     //     "product.discount" => "required",
    //     //     "product.quantity" => "required",
    //     //     "product.status" => "required",
    //     //     "product.description" => "required",
    //     //     "product.category_id" => "required",
    //     // ]);
    //     // if ($validator->fails()) {
    //     //     Session::put('producterror',$validator);
    //     // }
    //     $validator = Validator::make($request->all(), [
    //         "product.sku" => "required",
    //         "product.name" => "required",
    //         "product.price" => "required",
    //         "product.discount" => "required",
    //         "product.quantity" => "required",
    //         "product.status" => "required",
    //         "product.description" => "required",
    //         "product.category_id" => "required",
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect('product/form')->withErrors($validator,'formValue')->withInput();
    //         // return redirect('product/form')
    //         //             ->withErrors($validator,'formValue')
    //         //             ->withInput();
    //     }
    //     //     $validator = $request->validate([
    //     //     "product.sku" => "required",
    //     //     "product.name" => "required",
    //     //     "product.price" => "required",
    //     //     "product.discount" => "required",
    //     //     "product.quantity" => "required",
    //     //     "product.status" => "required",
    //     //     "product.description" => "required",
    //     //     "product.category_id" => "required",
    //     // ]);
    
    //     $product = $this->getProductModel();
    //     $formData = $request->get('product');
    //     date_default_timezone_set('Asia/Kolkata');
    //     if( $product->saveData($formData))
    //     {
    //         Session::put('productSave', 'Product Saved successfully!!!');
    //         return redirect('/product')->withErrors($validator, 'login');
    //     }
    //     // echo 111111;
    //     // exit();
         
       
    //     } catch (\Exception $e) {
    //        echo  $e->getMessage();
    //     //    die;
    //         Session::put('producterror',$e->getMessage());
    //         return redirect()->back()->withInput();
    //     //     die;
          
    //     }
        
    //     $this->gridAction();
    // }

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
            ]);
           

            if ($validator->fails()) {
                // return response()->json(['success'=>'Added new records.']);
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        //  else{
        //     //  return redirect('/product/form')->with($validator->errors());
             
        //  }
           
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()->all()]);
        // }
        $product = $this->getProductModel();
        $formData = $request->get('product');
        // print_r($formData);
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            $formData['id'] = $id;
            $formData['updated_at'] = date('Y-m-d h:i:s');
        } else {
            $formData['created_at'] = date('Y-m-d h:i:s');
        }
        
        if ($product->saveData($formData)) {
            // Session::put('productSave', 'Product Saved successfully!!!');
                    return redirect('/product')->with('productSaves', 'Product Saved successfully!!!');
        }
        }
        
        catch (\Exception $e) {
                   echo  $e->getMessage();
                //    die;
                // Session::put('proeer',$validator->errors());
                    // return redirect()->back()->withInput();
                //     die;
                  
                }
       

    }

    

    public function deleteAction($id)
    {
         $product = $this->getProductModel();
        if (!$product->deleteData([$id])) {
            return redirect('/product')->with('error', 'ERROR WHILE DELETING');
        }
        return redirect('/product')->with('productDelete', 'Product Deleted successfully!!!');;
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

        $parent = CategoryModel::where('id', $categoryName->getCategories()->parentId)->get();
        $parentCat =  $categoryModel->load($id);
        $child = $categoryNamefind->childs;
       if (count($child)) {
           echo 123;
            if (count($parentCat)) {
                foreach ($child as $value) {
                    echo $value->parentId = $parentCat[0]->id;
                    
                }
            }
        }
       
        // if (count($parent)) {
            
        //     echo $parentCat->getCategories()->name;
        // }

        // if(!$categoryNamefind)
        // {
        //     echo 'category not found!!!';
        // }
        // else{
        //     return $categoryName->getCategories()->name;
        // }
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
            $view = \view('product.tabs.media')->with('product', $this)->render();
            $response = [
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => $view
                    ]
                ]
            ];
            header('content-type: application/json');
            echo json_encode($response);
            die();
            
        } else {

            $media = new Media;

            $media = $media->fetchAll("select * from media where product_id=$id");

            if ($media->getMedias()) {
                $this->setMedias($media->getMedias());
            }

            $view = \view('product.tabs.media')->with('product', $this)->render();

            $response = [
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => $view
                    ]
                ]
            ];
        
        header('content-type: application/json');
        echo json_encode($response);
        die();
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
        return redirect('/product')->with('productStatus', 'Product Status Changed successfully!!!');
    }


    public function setPageAction(Request $request)
    {
        Session::put('page', $request->recordPerPage);

       if ($request->page == 'customerGrid') {
            return redirect('/customerGrid');
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
            return redirect('/product');
        }
    }
}
