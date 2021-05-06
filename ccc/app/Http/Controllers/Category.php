<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;

class Category extends Controller
{
    protected $categories=[];
    public function gridAction($id=NULL,Request  $request) 
    {
       echo $id;
        $parentcategories = CategoryModel::where('parent_id', '=', 0)->get();
        $allCategories = CategoryModel::pluck('name','id')->all();
        if($id)
        {
             $categoryData= Category::editAction($id,$request);
           return view('category.grid',compact('parentcategories','allCategories','categoryData'));
        }
        
        return view('category.grid',compact('parentcategories','allCategories'));
    }

    public function FormAction($id,$request)
    {
        $categoryId = $request->id;
        $categoryModel = new CategoryModel;
        $categoryData = $categoryModel->load($categoryId)->getCategories();
       return $categoryData;
    
    }

    public function deleteAction($id, Request $request)
    {
        (new CategoryModel)->deleteValue($id);

        return redirect()->back();
    } 

    public function editAction($id,Request $request)
    {
        $categoryId = $id;
        $categoryModel = new CategoryModel;
        $categoryData = $categoryModel->load($categoryId)->getCategories();
       return $categoryData;
    }
    public function editSaveAction($id,Request $request)
    {
        $editData =$_GET['category'];
        $editData['id']=$id;
        echo $editData['id'];
        // print_r($editData);
        // die;
        $categoryModel = new CategoryModel;
        $categoryModel->saveValue($editData);
        return redirect()->back();
    }
    public function addSubCategoryAction(Request $request)
    {
        
        $id=$request->id;
        $parentcategories = CategoryModel::where('parent_id', '=', 0)->get();
        $allCategories = CategoryModel::pluck('name','id')->all();
        return view('category.addSubCategory',compact('parentcategories','allCategories'));
    }

    public function addnewSubCategory($id,Request $request)
    {
        echo $categoryId=$request->id;
        $editData =$_GET['category'];
        echo $editData['parent_id']=$id;
        $categoryModel = new CategoryModel;
        print_r($editData);

        // $categoryModel->saveValue($editData);
        // return redirect()->back();
    }
    public function addRootCategoryAction()
    {
        $parentcategories = CategoryModel::where('parent_id', '=', 0)->get();
        $allCategories = CategoryModel::pluck('name','id')->all();
        
        return view('category.addCategory',compact('parentcategories','allCategories'));
    }

    public function rootCategoryEditSaveAction()
    {
      $formData=$_GET['category'];
      print_r($formData);
      $formData['parent_id']=0;
      $categoryModel = new CategoryModel;
     $categoryModel->saveValue($formData);
     return redirect()->back();
    }
}
