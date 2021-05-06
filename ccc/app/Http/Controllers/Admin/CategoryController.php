<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
   public function index()
   {
    // $parentCategories = Category::where('parent_id',NULL)->get();
    // return view('admin.category.index', compact('parentCategories'));
    // return view('categories', compact('parentCategories'));
       $category = Category::all();
       return view('admin.category.index',['category'=>$category]);
   }

   public function create()
   {
       return view('admin.category.create');
   }

   public function selectPath()
   {
    foreach(Category::with('child')->where('parent_id',0)->get() as $items)
    {
        if($items->count()>0)
        {
            $item=explode("=",$items->name);
            foreach($items->child as $submenu)
            {
                // print_r($submenu->name);
            }
        }
    }
   }

}
