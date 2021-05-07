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

    public function gridAction()
    {
        $product = $this->getProductModel();
        $this->setProducts($product->fetchAll());
        return \view('product.product')->with('product', $this);
    }

    public function formAction($id = null)
    {
        if (!$id) {
            return \view('product.tabs.form')->with('product', $this);
        }

        $product = new ProductModel;

        $product = $product->load($id);

        if ($product->getProducts()) {
            $this->setProducts($product->getProducts());
        }

        return \view('product.tabs.form')->with('product', $this);
    }

    public function mediaAction($id)
    {
        $this->id = $id;

        if (!$id) {
            return \view('product.tabs.media')->with('product', $this);
        }

        $media = new Media;

        $media = $media->fetchAll("select * from media where product_id=$id");

        if ($media->getMedias()) {
            $this->setMedias($media->getMedias());
        }

        return \view('product.tabs.media')->with('product', $this);
    }

    public function saveAction($id = null)
    {
        $product = $this->getProductModel();

        $formData = $_POST['product'];


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
    }

    public function deleteAction($id)
    {
        

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
}
