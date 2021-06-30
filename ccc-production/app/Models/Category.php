<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
class Category extends Core\Adapter
{
    use HasFactory;

    protected $categories = [];

    public $fillable = ['name', 'parentId'];

    public function __construct()
    {
        $this->setTable('categories');
    }


    public function childs()
    {
        return $this->hasMany(Category::class, 'parentId', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'id', 'parentId');
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $this->categories = DB::table($this->getTable())->get();
            return $this;
        }

        $this->categories = DB::select($query);
        return $this;
    }

    public function load($id)
    {
        $this->categories = DB::table($this->getTable())->where('id', $id)->first();
        return $this;
    }

    public function saveData($category)
    {
        try {
            if (array_key_exists('id', $category)) {
                return $this->updateData($category);
            } else {
                return $this->insert($category);
            }
        } catch (Exception $e) {
            $e->getMessage();
            //return false;
        }
    }

    public function insert($category)
    {
        try {
            $insertedId = DB::table($this->table)->insertGetId($category);
            return ($insertedId) ? $insertedId : false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateData($category)
    {
        $update = DB::table($this->table)->where($this->primaryKey, $category[$this->primaryKey])->update($category);
        return ($update) ? true : false;
    }

    public function deleteData($id)
    {
        $delete = DB::table($this->table)->where($this->primaryKey, '=', $id)->delete();
        return ($delete) ? true : false;
    }
}
