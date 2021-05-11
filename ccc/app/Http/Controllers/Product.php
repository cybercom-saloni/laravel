<?php

namespace App\Http\Controllers;

use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Product\Media;
use Facade\FlareClient\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Controller
{
    protected $products = [];
    protected $medias = [];
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
        $products = new ProductModel;
        $this->setProducts($products->fetchAll());
        $view = \view('product.product',['products'=>$this->getProducts(),'controller'=>$this])->render();

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

    // public function formAction($id = null)
    // {
    //     if (!$id) {
    //         $view = \view('product.tabs.form')->with('product', $this)->render();
    //         $response = [
    //             'element' => [
    //                 [
    //                     'selector' => '#content',
    //                     'html' => $view
    //                 ]
    //             ]
    //         ];
    
    //         header('content-type:application/json');
    //         echo json_encode($response);
    //     } else {
    //         $product = new ProductModel;

    //         $product = $product->load($id);

    //         if ($product->getProducts()) {
    //             $this->setProducts($product->getProducts());
    //         }

    //         $view = \view('product.tabs.form')->with('product', $this)->render();

    //     $response = [
    //         'element' => [
    //             [
    //                 'selector' => '#content',
    //                 'html' => $view
    //             ]
    //         ]
    //     ];

    //     header('content-type:application/json');
    //     echo json_encode($response);
    //   }
    // }

    public function formAction($id = null)
    {
        if (!$id) {
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

   
    
    public function saveAction($id = null,Request $request)
    {
        $product = $this->getProductModel();
        $formData = $request->get('product');
        date_default_timezone_set('Asia/Kolkata');
        if ($id) {
            $formData['id'] = $id;
            $formData['updated_at'] = date('Y-m-d h:i:s');
        } else {
            $formData['created_at'] = date('Y-m-d h:i:s');
        }
        
        if (!$product->saveData($formData)) {
            return redirect()->back()->withInput();
        }
         return redirect('/product');
        // if (array_key_exists('created_at', $formData)) {
        //     //return redirect()->back();
        //     return redirect('/product');
        // } else {
        //     return redirect('/product/form/' . $id);
        // }
       

    }

    public function deleteAction($id)
    {
         $product = $this->getProductModel();
        if (!$product->deleteData([$id])) {
            return redirect('/product')->with('error', 'ERROR WHILE DELETING');
        }
        return redirect('/product')->with('success', 'DELETED');
    }

    public function getCategoryOptions($id = null)
    {
        $category = new CategoryModel();

        return $category->fetchAll()->getCategories();
    }

    public function getCategoryName($id)
    {
        $category = new CategoryModel();

        $categoryRow = (array)$category->load($id)->getCategories();

        return $categoryRow['name'];
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
        return redirect('/product');
    }
}
