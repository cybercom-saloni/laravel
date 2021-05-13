<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    use HasFactory;
    protected $categories=[];

    public function __construct()
    {
        $this->setTable('categories');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function getCategories()
    {
        return $this->categories;
    }

    public function fetchAll($query=null)
    {
        if(!$query)
        {
            $this->categories = DB::table($this->getTable())->get();
            return $this;
        }
        $this->categories = DB::select($query);
        return $this;
    }

    public function saveValue($categories)
    {
       
        if(array_key_exists('id',$categories))
        {
            // echo 111;
            // die;
            return $this->updateValue($categories);
        }
        else
        {
            return $this->insertValue($categories);
        }
    }

    public function insertValue($categories)
    {
        $id = DB::table($this->table)->insertGetId($categories);
        return ($id) ? $id : false; 
    }

    public function updateValue($categories)
    {
         $id = DB::table($this->table)->where($this->primaryKey,$categories[$this->primaryKey])->update($categories);
        return ($id) ? true : false;
    }

    public function load($id)
    {
        $this->categories = DB::select("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?",[$id]);
        return $this;
    }

    public function deleteValue($id)
    {
        $categories = DB::table($this->table)->where($this->primaryKey,"=",$id)->delete();
        return ($categories) ? true : false;
    }
}
