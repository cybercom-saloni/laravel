<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\Redirect;

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
        $categories = CategoryModel::whereNull('parent_id')->orderBy('name')->get();
        $allCategories = CategoryModel::pluck('name', 'id')->all();

        if ($id) {
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

    public function getSubCategories($parent_id)
    {
        $category = new CategoryModel;

        $subCategories = $category->fetchAll("select * from categories where parent_id = $parent_id");

        return $subCategories;
    }

    public function addAction($id = null)
    {
        try {
            $data = request()->category;

            if ($id) {
                $data['parent_id'] = $id;
            }

            $this->getModel()->insert($data);
            return redirect(route('formEdit'))->with('Added','Category Added!!!');

        } catch (\Exception $e) {
            $e->getMessage();
            // return Redirect::back()->with('error','Category Field Empty!!!')
            return redirect(route('formEdit'))->with('error','Category Fields Empty!!!');
        }
    }

    public function updateAction($id, Request $request)
    {
        $data = $request->get('category');

        $data['id'] = $id;

        (new CategoryModel)->saveData($data);
        return redirect(route('formEdit'))->with('Updated','Category updated!!!');
        // return redirect()->back()->with('Delete','Category Deleted!!!');
    }

    public function deleteAction($id)
    {
        $category = CategoryModel::find($id);

        $parent = CategoryModel::where('id', $category->parent_id)->get();
        $child = $category->childs;

        if (count($child)) {
            if (count($parent)) {
                foreach ($child as $value) {
                    $value->parent_id = $parent[0]->id;
                    $value->save();
                }
            }
        }

        (new CategoryModel)->deleteData($id);

        return redirect(route('formEdit'))->with('Delete','Category Deleted!!!');
    }

}
