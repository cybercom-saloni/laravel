<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;

class Category extends Controller
{
    protected $categories=[];
    public function testaction()
    {
        $response = [
                    'element' => [
                        [
                            'success' =>'hello',
                        ]
                    ]
                ];
                header('content-type:application/json');
                echo json_encode($response);
                die();   
    }

    

     public function gridAction($id=NULL,Request  $request) 
    {
        // $response = [
        //     'success' =>'hello',
        // ];

        //     header('content-type:application/json');
        //     echo json_encode($response);
           $category_id=$request->id;
         $parentcategories = CategoryModel::whereNull('parent_id')->get();
        $parent_id=0;
        $allCategories = CategoryModel::pluck('status')->all();
    // //     // print_r($allCategories);
    // //         //  $categoryData = Category::editAction($id,$request);
            $categoryData = (new CategoryModel)->load($id)->getCategories();
        //    $view = view('category.grid',\compact('parentcategories','allCategories','categoryData','parent_id'))->render();
       $view = view('category.grid',['parentcategories'=>$parentcategories,'allCategories'=>$allCategories,'categoryData'=>$categoryData,'parent_id'=>$parent_id,'category_id'=>$category_id])->render();
           $response = [
            'element' => [
                [
                    'selector' =>'#content',
                    'html' =>$view
                ]
            ]
        ];

        header('content-type:application/json');
        echo json_encode($response);
        die();
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
        $categoryData = CategoryModel::find($id);
        $parentPath = CategoryModel::where('id', $categoryData->parent_id)->get();
        $childPath = $categoryData->child;
        echo count($childPath);
        echo count($parentPath);
        if (count($childPath)) {
            if (count($parentPath)) {
                foreach ($childPath as $child) {
                    $child->parent_id = $parentPath[0]->id;
                    $child->save();
                }
            }
        }
        (new CategoryModel)->deleteValue($id);
        return redirect('/tree');
    } 


    // public function deleteAction($id, Request $request)
    // {
       
    //     $categoryData = CategoryModel::find($id);
    //     $parentPath = CategoryModel::where('id', $categoryData->parent_id)->get();
   
    //     $childPath = $categoryData->child;
    //     echo count($childPath);
    //     echo count($parentPath);
    //     if (count($childPath)) {
    //         if (count($parentPath)) {
    //             echo 222;
    //             foreach ($childPath as $child) {
    //                 $child->parent_id = $parentPath[0]->id;
    //                 $child->save();
    //             }
    //         }
    //         // if(count($parentPath)==0)
    //         // {
    //         //     echo 1111;
    //         // }
    //     }
    //     // (new CategoryModel)->deleteValue($id);
    //     // return redirect('/tree');
    // } 

    public function editAction($id,Request $request)
    {
        $categoryId = $id;
        $categoryModel = new CategoryModel;
        $categoryData = $categoryModel->load($categoryId)->getCategories();
       return $categoryData;
    }
    public function editSaveAction($id,Request $request)
    {
        $editData =$request->get('category');
        $editData['id']=$id;
        // echo $editData['id'];
        // print_r($editData);
        // die;
        $categoryModel = new CategoryModel;
        $categoryModel->saveValue($editData);
         return redirect('tree');
    }
    // public function addSubCategoryAction(Request $request)
    // {
        
    //     $id=$request->id;
    //     $parent_id=$request->id;
    //     $parentcategories = CategoryModel::where('parent_id', '=', 0)->get();
    //     $allCategories = CategoryModel::pluck('name','id')->all();
    //     return view('category.addSubCategory',compact('parentcategories','allCategories','parent_id'));
    // }

    public function addSubCategoryAction(Request $request)
    {
        
        $category_id=$request->id;
        $parent_id=$request->id;
        $parentcategories = CategoryModel::whereNull('parent_id')->get();
        $allCategories = CategoryModel::pluck('name','id')->all();
        $view = view('category.addSubCategory',\compact('parentcategories','allCategories','parent_id','category_id'))->render();
        $response = [
            'element' => [
                [
                    'success' =>'hello',
                    'name' => 'saloni',
                    'selector' =>'#content',
                    'html' =>$view
                ]
            ]
        ];

        header('content-type:application/json');
        echo json_encode($response);
        die();
        
    }

    public function addnewSubCategory($id,Request $request)
    {
        $categoryId=$request->id;
        $editData =$_GET['category'];
        $editData['parent_id']=$id;
        $categoryModel = new CategoryModel;
        print_r($editData);

         $categoryModel->saveValue($editData);
         return redirect('tree');
    }
    public function addRootCategoryAction()
    {
        $parentcategories = CategoryModel::whereNull('parent_id')->get();
        // echo $parent_id=$parentcategories[0]->parent_id;
        $allCategories = CategoryModel::pluck('name','id')->all();
        $view = view('category.addCategory',compact('parentcategories','allCategories'))->render();
        $response = [
            'element' => [
                [
                    'success' =>'hello',
                    'name' => 'saloni',
                    'selector' =>'#content',
                    'html' =>$view
                ]
            ]
        ];

        header('content-type:application/json');
        echo json_encode($response);
        die();
    }

    public function rootCategoryEditSave(Request $request)
    {
      $formData=$_GET['category'];
      $formData['parent_id']=null;
      $categoryModel = new CategoryModel;
      print_r($formData);
      $categoryModel->saveValue($formData);
     return redirect('tree');
    }

    public function treeAction(Request $request)
    {
        $parentcategories = CategoryModel::whereNull('parent_id')->get();
        $parent_id=null;
        $allCategories = CategoryModel::pluck('name','id')->all();
    
        $view = view('category.tree',compact('parentcategories','allCategories','parent_id'))->render();
        $response = [
            'element' => [
                [
                    'success' =>'hello',
                    'name' => 'saloni',
                    'selector' =>'#content',
                    'html' =>$view
                ]
            ]
        ];

        header('content-type:application/json');
        echo json_encode($response);
        die();
    }
}
