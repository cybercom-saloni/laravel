<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute as AttributeModel;
use App\Models\Attribute\Option as OptionModel;
use App\Models\entityType;
use Exception;
class Attribute extends Controller
{
    public function indexAction()
    {
        $attribute = AttributeModel::all();
        $controller = $this;
        return view('manageFormAttribute.index',compact('attribute','controller'));
    }

    public function createAction()
    {
        $controller = $this;
        return view('manageFormAttribute.create',compact('controller'));
    }

    public function entityName($id)
    {
        $entity = entityType::find($id);
       return $entity->entity_name;
    }

    public function getAllEntityName()
    {
       $entity = entityType::where('status',1)->orderBy('sort_order')->get();
       return $entity;
    }

    public function getInputTypeOption()
    {
        return [
            'text'=>'text',
            'textarea'=>'textarea',
            'select'=>'select',
            'checkbox'=>'checkbox',
            'radio'=>'radio',
            'multiselect'=>'multiselect',
            'date'=>'date'
        ];
    }
    public function getBackEndTypeOption()
    {
        return [
            'varchar'=>'varchar',
            'bigint'=>'bigint',
            'tinyint'=>'tinyint',
            'decimal'=>'decimal',
            'text'=>'text',
            'timestamp'=>'timestamp'
        ];
    }

    public function statusAction($id)
    {
        $entity = AttributeModel::find($id);
        if ($entity->status == 0) {
            $entity->status = 1;
        }
        else {
            $entity->status = 0;
        }
        $entity->save();
        return redirect('/admin/AttributeformName')->with('success', 'Attribute Status Changed successfully!!!');
    }

    public function saveAction(Request $request)
    {
       $attributes= new AttributeModel;

       $entityForm = $request->get('attribute');
       foreach ($entityForm as $key => $value) {
           $attributes->setAttribute($key,$value);
       }
        // print_r($attributes);
       $attributes->save();
       return redirect('/admin/AttributeformName')->with('success', 'attribute Saved successfully!!!');
    }

    public function deleteAction($id)
    {
        $entityType = AttributeModel::find($id);
        $entityType->delete();
        return redirect('/admin/AttributeformName')->with('success','Entity Deleted!!!');
    }

    public function editAction($id)
    {
        try{
            if (!$id)
        {
            return redirect('/admin/AttributeformName')->with('error','id not found!!');
        }
        else
        {
            $product = new AttributeModel;
            $product = AttributeModel::find($id);
            if(!$product)
            {
                return redirect('/admin/AttributeformName')->with('error','id not found!!');
            }
            return view('manageFormAttribute.edit',['attributeEdit'=> $product,'controller'=>$this]);
        }
        }catch(Exception $e)
        {

        }
    }

    public function editSaveAction($id=null, Request $request)
    {
        $attributeForm = $request->get('attribute');
        AttributeModel::updateOrInsert(['id'=>$id],$attributeForm);
        return redirect('/admin/AttributeformName')->with('success', 'attribute Saved successfully!!!');
    }

    public function optionAction($id)
    {
        $attribute = OptionModel::where('attribute_id',$id)->orderBy('sort_order')->get();
        return view('manageFormAttribute.option',compact('attribute'));
    }

    public function optionSaveAction($id,Request $request)
    {
    $attributeOption = new OptionModel();
    //old values
    foreach($request->get('Exist') as $value)
    {
        $key = array_keys($value);
        $option = array_values($value);
        $attributeOption = array_combine($key,$option);
        OptionModel::where("id", $attributeOption['id'])->update(["name" => $attributeOption['name'],"sort_order"=> $attributeOption['sort_order']]);
    }

    //new values
        if($request->get('New'))
        {
            $attributeOption = new OptionModel();
            foreach($request->get('New') as $key=> $value)
            {
                $attributeOption['attribute_id'] = $id;
                $attributeOption['status'] = 1;
                $attributeOption->setAttribute($key,$value);
            }
            $attributeOption->save();
            return redirect()->back()->with('success','option added successfully');

        }
        else
        {
            return redirect()->back()->with('success','option edited successfully');
        }


    }

    public function optionDeleteAction($id=null)
    {
       if(!$id)
       {
        return redirect()->back()->with('error','error in option..');

       }
        $attribute = OptionModel::find($id);
        $attribute->delete();
        return redirect()->back()->with('success','option deleted successfully');


    }
}
