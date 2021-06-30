<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\File;
class Category extends Controller
{
    public $rootCategories = [];

    public function gridAction($id = null, $type = null, Request $request)
    {
        $controller = $this;

        $categories = ModelsCategory::whereNull('parentId')->orderBy('name')->get();

        $allCategories = ModelsCategory::pluck('name', 'id')->all();

        if ($id != 0 && $type == 'category') {
            $singleCategory = ModelsCategory::find($id);

            return view('category.grid', \compact('categories', 'allCategories', 'singleCategory', 'controller'));
        } else {
            return view('category.grid', \compact('categories', 'allCategories', 'controller'));
        }
    }

    public function getSubCategories($parentId)
    {
        $category = new ModelsCategory;

        $subCategories = $category->fetchAll("select * from category where parentId = $parentId");

        return $subCategories;
    }

    public function categoryName($id)
    {
        $category = ModelsCategory::find($id);

        if (!$category) {
            return null;
        }
        return $category->name;
    }

    public function saveAction($id = null, $type = null, Request $request)
    {
        try {
            $data = $request->get('category');
            // print_r($data);
            // die;
            if ($id != 0 && $type == 'subCategory') {
                $data['parentId'] = $id;
            } elseif ($id != 0 && $type == 'category') {
                $data['id'] = $id;
            }

            $insertId = (new ModelsCategory)->saveData($data);


            Session::forget('error');
            if ($insertId && $type == 'subCategory' || $type == 'root') {
                Session::put('success', "Category Added");
            } else {
                Session::put('success', "Category Updated");
            }
        } catch (Exception $e) {
            Session::forget('success');
            Session::put('error', $e->getMessage());
        }


        if ($insertId && $type == 'subCategory') {

            return redirect()->route('formEdit', ['id' => $insertId, 'type' => 'category']);
        } else {
            return redirect()->route('formEdit', ['id' => $id, 'type' => 'category']);
        }
    }


    public function deleteAction($id, Request $request)
    {

        try {
            $category = ModelsCategory::find($id);

            $parent = ModelsCategory::where('id', $category->parentId)->get();
            $child = $category->childs;



            if (\count($child)) {
                if (\count($parent)) {
                    foreach ($child as $value) {
                        $value->parentId = $parent[0]->id;
                        $value->save();
                    }
                }
            }


            if (!(new ModelsCategory)->deleteData($id)) {
                throw new Exception("Category Deleted Fail", 1);
            }

            Session::put('success', "Category Deleted Successfully");
        } catch (Exception $e) {
            Session::forget('success');
            Session::put('error', $e->getMessage());
        }


        return \redirect(route('formEdit', ['id' => 0, 'type' => 'root']));
    }

    public function saveNestedCategories(Request $request){
        echo"<pre>";
        $json = $request->nested_category_array;
        $decoded_json = json_decode($json, TRUE);

        $simplified_list = [];
        $categorySave = new ModelsCategory;
        $a= $this->recur1($decoded_json, $simplified_list);
        // print_r($simplified_list);
        foreach($simplified_list as $key => $value)
        {
            // echo $key;
            $id = $value['id'];
            $categorySave = ModelsCategory::where('id',$id)->first();

            // $values = array_values($value);
            //         $fields = array_keys($value);
            //         $final = array_combine($fields, $value);
                    // print_r($value);


                    // $mediaModel = new ProductMedia;

                    $categorySave->setRawAttributes($value);
                    $categorySave->save();
            // $categorySave->setRawAttributes($value);
        }
        print_r($categorySave);
        return redirect()->route('formEdit', ['id' =>0, 'type' => 'root']);
        // die;
        // DB::beginTransaction();
        // try {
        //     $info = [
        //         "success" => FALSE,
        //     ];

        //     foreach($simplified_list as $k => $v){
        //         $category = ModelsCategory::find($v['id']);
        //         $category->fill([
        //             "parentId" => $v['parentId'],
        //             "sort_order" => $v['sort_order'],
        //         ]);

        //         $category->save();
        //     }

        //     DB::commit();
        //     $info['success'] = TRUE;
        // } catch (\Exception $e) {
        //     // DB::rollback();
        //     $info['success'] = FALSE;
        // }

        // if($info['success']){
        //     echo "success";
            // return redirect()->route('formEdit', ['id' =>0, 'type' => 'root']);
        // }



    }

    public function recur1($nested_array=[], &$simplified_list=[]){

        static $counter = 0;

        foreach($nested_array as $k => $v){

            $sort_order = $k+1;
            $simplified_list[] = [
                "id" => $v['id'],
                "parentId" => NULL,
                "sort_order" => $sort_order
            ];

            if(!empty($v["children"])){
                $counter+=1;
                $this->recur2($v['children'], $simplified_list, $v['id']);
            }

        }
    }

    public function recur2($sub_nested_array=[], &$simplified_list=[], $parentId = NULL){

        static $counter = 0;

        foreach($sub_nested_array as $k => $v){

            $sort_order = $k+1;
            $simplified_list[] = [
                "id" => $v['id'],
                "parentId" => $parentId,
                "sort_order" => $sort_order
            ];

            if(!empty($v["children"])){
                $counter+=1;
                return $this->recur2($v['children'], $simplified_list, $v['id']);
            }
        }
    }
}
