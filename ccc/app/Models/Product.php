<?php

namespace App\Models;


use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category as CategoryModel;

class Product extends Model
{
    use HasFactory;

    protected $products = [];

    public function __construct()
    {
        $this->setTable('products');
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $this->products = DB::table($this->getTable())->get();
            return $this;
        }

        $this->products = DB::select($query);
        return $this;
    }

    public function load($id)
    {
        $this->products = DB::select("select * from {$this->table} where {$this->primaryKey} = ?", [$id]);
        return $this;
    }

    public function saveData($product)
    {
        try {
            if (array_key_exists('id', $product)) {
                return $this->updateData($product);
            } else {
                return $this->insert($product);
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function insert($product)
    {
        $insertedId = DB::table($this->table)->insertGetId($product);
        return ($insertedId) ? $insertedId : false;
    }

    public function updateData($product)
    {
        $update = DB::table($this->table)->where($this->primaryKey, $product[$this->primaryKey])->update($product);
        return ($update) ? true : false;
    }

    public function deleteData($id)
    {
        $delete = DB::table($this->table)->where($this->primaryKey, '=', $id)->delete();
        return ($delete) ? true : false;
    }

    public function getCategoryOptions($id = null)
    {
        $category = new CategoryModel();

        return $category->fetchAll()->getCategories();
    }
}
