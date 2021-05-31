<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $categories = [];

    public $fillable = ['name', 'parent_id'];

    public function __construct()
    {
        $this->setTable('categories');
    }


    public function getSingleCategory($id = null)
    {
        if(!$id)
        {
            $categories = DB::table('categories')->select('id','name')->get();

            return $categories;
        }

        $categories = DB::table('categories')->where('id',$id)->get();

        return $categories;
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
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
            return false;
        }
    }

    public function insert($category)
    {
        $insertedId = DB::table($this->table)->insertGetId($category);
        return ($insertedId) ? $insertedId : false;
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
