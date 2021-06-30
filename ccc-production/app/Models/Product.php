<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category as CategoryModel;
use Kyslik\ColumnSortable\Sortable;

class Product extends Core\Adapter
{
    use HasFactory;
    use Sortable;

    protected $products = [];

    protected $table = 'products';
    public function __construct()
    {
        $this->setTable('products');
    }

    protected $fillable=['name','sku','price','discount','quantity','description','status','category_id'];
    public $sortable =['id','name','sku','price','discount','quantity','description','status','category_id'];
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
