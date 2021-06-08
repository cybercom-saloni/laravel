<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category as CategoryModel;

class Product extends Core\Adapter
{
    use HasFactory;

    protected $products = [];

    public function __construct()
    {
        $this->setTable('products');
    }

    public function getCategories()
    {
        return $this->categories;
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


    public function getCategoryOptions($id = null)
    {
        $category = new CategoryModel();

        return $category->fetchAll()->getCategories();
    }
}
