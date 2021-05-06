<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as ModelCategory;
use Facade\FlareClient\View;
use Illuminate\Database\Eloquent\Model;

class Category extends Controller
{
    protected $category =[];
    protected $modelCategory=null;
    protected $categoryOptions=[];

   public function getCategoryModel()
   {
       if(!$this->modelCategory)
       {
        $this->setCategoryModel();
       }
       return $this->modelCategory;
   } 

   public function setCategoryModel($modelCategory = null)
   {
      if(!$this->modelCategory)
      {
          $modelCategory = new ModelCategory();
      }
      $this->modelCategory = $modelCategory;
   }
   
   public function setCategories($category)
   {
        $this->category = $category;
        return $this;
   }

   public function getCategories()
   {
       return $this->category;
   }

   public function gridAction()
   {
       $this->setCategories($category->fetchAll());
       return \view('admin.category.grid')->with('categories',$this);
   }

   public function getName($category)
   {
       $category = $this->getCategoryModel();
       if(!$this->categoryOptions)
       {
        $query="SELECT `category_id`,`name` FROM `categories`";
            $options =  $this->setCategories($category->fetchPair($query)); 
            // echo "<pre>";
            // print_r($values);
            // $query="SELECT `category_id`,`path_id` FROM `categories`";
            // $this->categoryOptions = $this->setCategories($category->fetchAll($query));
            // echo "<pre>";
            // print_r($this->categoryOptions);
            // die;
            $pathId = explode("=",$category->path_id);
           foreach($pathId as $key =>&$id)
           {
               if(array_key_exists($id,$this->categoryOptions))
               {
                   $id = $this->categoryOptions[$id];
               }
               $name = implode('/',$pathId);
               return $name;
           }
       }
   }
}
