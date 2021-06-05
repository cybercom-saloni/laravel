<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Core\Adapter
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
        return $this->hasMany(Category::class, 'parentId', 'id');
    }

    public function getCategories()
    {
        return $this->categories;
    }

    
}