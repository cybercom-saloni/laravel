<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute as AttributeModel;
use App\Models\Attribute\Option as OptionModel;
use Illuminate\Support\Facades\Session;
use App\Models\entityType;
use Exception;
class Attribute extends Controller
{
    public function indexAction($id,Request $request)
    {
       $entity_slug = entityType::find($id);
        $attribute = AttributeModel::where('entity_type_id',$id)->get();
        // Session::put('entity_type_id',$id);/
        $formName = $entity_slug->entity_name;
        $request->session()->put('entity_type_id',$id);
        $controller = $this;
        return view('manageFormAttribute.index',compact('attribute','formName','controller'));
    }
    
    public function createAction()
    {
        $controller = $this;
        $entity_name = request()->session()->get('entity_type_id');
       $entity_type_id = request()->session()->get('entity_type_id');
        $fields = AttributeModel::where('entity_type_id',$entity_type_id)->orderBy('sort_order')->get();
        $formName = entityType::where('id',$entity_type_id)->pluck('entity_name')->first();
        //    $entity_name = $this->entityName($entity_type_id);
       return view('manageFormAttribute.create',compact('controller','entity_name','formName','fields'));
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

    public function statusAction($id,Request $request)
    {
       $entity_type_id = $request->session()->get('entity_type_id');
        $entity = AttributeModel::find($id);
        if ($entity->status == 0) {
            $entity->status = 1;
        }
        else {
            $entity->status = 0;
        }
        $entity->save();
        return redirect()->back()->with('success', 'Attribute Status Changed successfully!!!');
    }

    public function saveAction(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     "attribute.name" => "required|unique:attributes,name",
        //     "entity.slug" => "required",
        //     "entity.sort_order" => "required",
        //  ],[
        //      "entity.name.required" => "The entity name Field is required.",
        //      "entity.slug.required" =>"The entity slug Field is required.",
        //      "entity.name.unique" =>"The entity name Field should be unique.",
        //      "entity.sort_order.required" => "The entity sort_order Field is required.",
        //  ]);
        //  if ($validator->fails()) {
        //      return redirect('/admin/manageform/create')
        //      ->withErrors($validator)
        //      ->withInput();
        //  }
       $attributes= new AttributeModel;
       $entityForm = $request->get('attribute');
       foreach ($entityForm as $key => $value) {
           $attributes->setAttribute($key,$value);
       }

        if($attributes->input_type == 'text' || $attributes->input_type == 'select' || $attributes->input_type == 'radio' || $attributes->input_type == 'checkbox')
        {
           $attributes->backend_type='varchar';
        }
        elseif($attributes->input_type == 'textarea')
        {
           $attributes->backend_type='text';
        }
        elseif($attributes->input_type == 'date')
        {
           $attributes->backend_type='timestamp';
        }
       $attributes->save();
       $entity_type_id = $request->session()->get('entity_type_id');
       return redirect('admin/manageform/createfields')->with('success', 'field Saved successfully!!!');
    }

    public function deleteAction($id)
    {
        $entityType = AttributeModel::find($id);
        $entityType->delete();
       $entity_type_id = request()->session()->get('entity_type_id');
        return redirect()->back()->with('success','field  Deleted!!!');
    }

    public function editAction($id)
    {
        try{
       $entity_type_id = request()->session()->get('entity_type_id');
       $entity_name = request()->session()->get('entity_type_id');

            if (!$id)
        {
            return redirect('admin/manageform/viewfields/'.$entity_type_id)->with('error','id not found!!');
        }
        else
        {
            $product = new AttributeModel;
            $product = AttributeModel::find($id);
              $attribute = OptionModel::where('attribute_id',$id)->orderBy('sort_order')->get();
            $fields = AttributeModel::where('entity_type_id',$entity_type_id)->orderBy('sort_order')->get();
            $formName = entityType::where('id',$entity_type_id)->pluck('entity_name')->first();

            if(!$product)
            {
                return redirect('admin/manageform/viewfields/'.$entity_type_id)->with('error','id not found!!');
            }
            return view('manageFormAttribute.edit',['attributeEdit'=> $product,'controller'=>$this,'attribute'=>$attribute,'entity_name'=>$entity_name,'formName'=>$formName,'fields'=>$fields]);
        }
        }catch(Exception $e)
        {

        }
    }

    public function editSaveAction($id=null, Request $request)
    {
        $attributeForm = $request->get('attribute');

        AttributeModel::updateOrInsert(['id'=>$id],$attributeForm);
       $entity_type_id = $request->session()->get('entity_type_id');

        return redirect('admin/manageform/editfields/'.$id)->with('success', 'field Saved successfully!!!');
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
    if($request->get('Exist'))
    {
    foreach($request->get('Exist') as $value)
    {
        $key = array_keys($value);
        $option = array_values($value);
        $attributeOption = array_combine($key,$option);
        OptionModel::where("id", $attributeOption['id'])->update(["name" => $attributeOption['name'],"sort_order"=> $attributeOption['sort_order']]);
    }
    }

    //new values
        if($request->get('New'))
        {

            $count = count($request->get('New')['name']);

            for ($i=0; $i < $count; $i++) {
             $attributeOption = new OptionModel();
             $attributeOption['name'] = $request->get('New')['name'][$i];
             $attributeOption['sort_order'] = $request->get('New')['sort_order'][$i];
             $attributeOption['attribute_id'] = $id;
             $attributeOption['status'] = 1;
             $attributeOption->save();
            }
            return redirect()->back()->with('success','option added successfully');
        }
        else
        {
            return redirect()->back()->with('success','field option edited successfully');
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
        return redirect()->back()->with('success','field option deleted successfully');


    }


    // view form
    public function showAction($id=null,Request $request)
    {
       $entity_slug = entityType::find($id);
       $formName = $entity_slug->entity_name;
        $slug = $entity_slug->slug;
        $entity = entityType::where('slug',$slug)->first();
        $attribute = AttributeModel::where([['entity_type_id',$entity->id],['status',1]])->orderBy('sort_order')->get();
        $controller = $this;
        return view('frontend.form',compact('attribute','formName','controller','entity'));

    }

    public function showSlug()
    {
        $entity = entityType::where('status',1)->get();
       return $entity;
    }

    public function getValidation($id,$entityid)
    {
       $entity_type_id = request()->session()->get('entity_type_id');
        $attribute = AttributeModel::where([['entity_type_id',$entityid],['id',$id],['status',1]])->orderBy('sort_order')->pluck('validation')->first();

        $validation =explode(",",$attribute);
        $attribute =implode(" ",$validation);
       return $attribute;

    }
    public function getStyle($id,$entityid)
    {
        $attribute = AttributeModel::where([['entity_type_id',$entityid],['id',$id],['status',1]])->orderBy('sort_order')->pluck('style')->first();
        $validation =explode(",",$attribute);
        $attribute =implode(";",$validation);
       return $attribute;
    }
    public function getOptions($id)
    {
       $options = OptionModel::where([['attribute_id',$id],['status',1]])->orderBy('sort_order')->get();
       return $options;

    }
}
