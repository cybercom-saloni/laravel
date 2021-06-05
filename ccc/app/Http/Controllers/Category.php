<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class Category extends Controller
{
protected $model = null;

public function setModel($model = null)
{
    $this->model = new CategoryModel();
    return $this;
}

public function getModel()
{
    if(!$this->model)
    {
        $this->setModel();
    }
    return $this->model;
}

public function gridAction($id = null)
{
   
    $categories = CategoryModel::where('parentId','=','0')->orderBy('name')->get();
    $allCategories = CategoryModel::pluck('name', 'id')->all();

    if ($id) {
        Session::forget('Added');
        Session::forget('Updated');
        Session::forget('Delete');
        $singleCategory = (new CategoryModel)->load($id)->getCategories();

        $view = view('category.grid', \compact('categories', 'allCategories', 'singleCategory'))->render();

        $response = [
            'status' => 'success',
            'message' => 'hello',
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

    $view = view('category.grid', \compact('categories', 'allCategories'))->render();

    $response = [
        'status' => 'success',
        'message' => 'hello',
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

public function getSubCategories($parentId)
{
    $category = new CategoryModel;

    $subCategories = $category->fetchAll("select * from categories where parentId = $parentId");

    return $subCategories;
}

public function addAction($id = null,Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            "category.name" => "required|unique:categories,name,$id",
            "category.status" => "required",
        ]);
       

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $data = request()->category;
        if ($id) {
           
            $data['parentId'] = $id;
        }
        else
        {
            $data['parentId'] = 0;
        }
         $id = CategoryModel::insertGetId($data);
         $parentCategory = CategoryModel::find($id);
        //  $parentCategory->parentId;
         echo $childCategory = CategoryModel::find($parentCategory->parentId);
         
         if($parentCategory->parentId == 0)
         {
            $parentCategory->pathId = $id;
         }else
         {
            //  echo $parentCategory->parentId;
            //  echo $id;
             $parentCategory->pathId = $childCategory->pathId ."=".$id;
         }      
        $parentCategory->save();

        Session::forget('error');
        return redirect(route('formEdit'))->with('Added','Category Added!!!');

    } catch (\Exception $e) {
        $e->getMessage();
        
    }
}

public function updateAction($id, Request $request)
{
    try
    {
        $validator = Validator::make($request->all(), [
            "category.name" => "required|unique:categories,name,$id",
            "category.status" => "required",
        ]);
       

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
            die;
        }
        $data = $request->get('category');

        $data['id'] = $id;

        $value= (new CategoryModel)->saveData($data);
           return redirect(route('formEdit'))->with('Updated','Category updated!!!');
    
    }
    catch (\Exception $e) {
        $e->getMessage();
       
    }
    // return redirect()->back()->with('Delete','Category Deleted!!!');
}

// public function deleteAction($id)
// {
//     $category = CategoryModel::find($id);
//     $parent = CategoryModel::where('id', $category->parentId)->get();
//     $child = $category->childs;

//     if (count($child)) {
//         if (count($parent)) {
//             foreach ($child as $value) {
//                 $value->parentId = $parent[0]->id;
//                 $value->save();
//             }
//         }
//     }
    

//     (new CategoryModel)->deleteData($id);
   
//     return redirect(route('formEdit'))->with('Delete','Category Deleted!!!');
// }

public function deleteAction($id)
{
    
    $parentCategory = CategoryModel::find($id);
 
    $childCategory = CategoryModel::where("pathId","LIKE","%{$id}%")->WHERE('id','!=',$id)->get();
    
    foreach($childCategory as $category)
    {
        $category->parentId = $parentCategory->parentId;
        $category->pathId = $parentCategory->parentId."=".$category->id;
        // print_r($category->pathId);
       $category->save();
    }
    if($parentCategory->delete())
    {
        $categories = CategoryModel::all();
        if($categories)
        {
            $categories= $categories->where('parentId','0');
            foreach($categories as $key=>$category)
            {
                $category->pathId = $category->id;
                $category->save();
            }
        }
    }
    return redirect(route('formEdit'))->with('Delete','Category Deleted!!!');
}
}
