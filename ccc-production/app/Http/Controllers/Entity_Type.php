<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entityType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;

class Entity_Type extends Controller
{
    public function indexAction()
    {
        $entity = entityType::all();
     Session::forget('entity_type_id');
        // $entity = entityType::orderBy('sort_order','asc')->get();
        return view('manageForm.entityGrid',\compact('entity'));
    }
    public function createAction()
    {
        return view('manageForm.createEntity');

    }
    public function saveAction($id=null,Request $request)
    {
       try{
           $validator = Validator::make($request->all(), [
               "entity.entity_name" => "required|unique:dynamic_form,entity_name",
               "entity.slug" => "required",
               "entity.sort_order" => "required",
            ],[
                "entity.entity_name.required" => "The entity name Field is required.",
                "entity.slug.required" =>"The entity slug Field is required.",
                "entity.entity_name.unique" =>"The entity name Field should be unique.",
                "entity.sort_order.required" => "The entity sort_order Field is required.",
            ]);
            if ($validator->fails()) {
                return redirect('/admin/manageform/create')
                ->withErrors($validator)
                ->withInput();
            }
            $entityNew= new entityType;

            $entityForm = $request->get('entity');
            foreach ($entityForm as $key => $value) {
                $entityNew->setAttribute($key,$value);
            }
            // print_r($entityNew);
            $entityNew->save();
            return redirect('admin/manageform/view')->with('success', 'Entity Saved successfully!!!');


       }catch(Exception $e)
       {
           $e->getMessage();
       }


    }

    public function statusAction($id)
    {
        $entity = entityType::find($id);
        if ($entity->status == 0) {
            $entity->status = 1;
        }
        else {
            $entity->status = 0;
        }
        $entity->save();
        return redirect('admin/manageform/view')->with('success', 'Entity Status Changed successfully!!!');
    }

    public function editAction($id=null,Request $request)
    {
        try{
            if (!$id)
        {
            return redirect('admin/manageform/view')->with('error','id not found!!');

        }
        else
        {
            $product = new entityType;
            $product = entityType::find($id);
            if(!$product)
            {
                return redirect('admin/manageform/view')->with('error','id not found!!');
            }
            return view('manageForm.editEntity',['products'=> $product,'controller'=>$this]);
        }
        }catch(Exception $e)
        {

        }

    }

    public function editSaveAction($id=null,Request $request)
    {
        $validator = Validator::make($request->all(), [
            "entity.entity_name" => "required|unique:dynamic_form,entity_name,$id",
            "entity.slug" => "required",
            "entity.sort_order" => "required",
         ],[
             "entity.entity_name.required" => "The entity name Field is required.",
             "entity.slug.required" =>"The entity slug Field is required.",
             "entity.entity_name.unique" =>"The entity name Field should be unique.",
             "entity.sort_order.required" => "The entity sort_order Field is required.",
         ]);
         if ($validator->fails()) {
             return redirect('/admin/createFormNameEdit/'.$id)
             ->withErrors($validator)
             ->withInput();
         }

        $entityForm = $request->get('entity');
        entityType::updateOrInsert(['id'=>$id],$entityForm);
        return redirect('admin/manageform/view')->with('success', 'Entity Saved successfully!!!');

    }

    public function deleteAction($id)
    {
        $entityType = entityType::find($id);
        $entityType->delete();
        return redirect('admin/manageform/view')->with('success','Entity Deleted!!!');
    }
}
