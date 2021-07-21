<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute as AttributeModel;
use App\Models\Attribute\Option as OptionModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\entityType;
use App\Models\Form_Values;
use App\Models\Customer;
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
            'date'=>'date',
            'number'=>'number',
            'button'=>'button',
            'password'=>'password',
            'email'=>'email',
            'file'=>'file',
            'color'=>'color'
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
        $validator = Validator::make($request->all(), [
            "attribute.name" => "required",
            "attribute.entity_type_id" => "required",
            "attribute.sort_order" => "required",
            "attribute.input_type" => "required",
            "attribute.label" => "required",
            "attribute.placeholder" => "required",
            "attribute.isrequired" => "required",
            "attribute.status" => "required",

         ],[
             "attribute.name.required" => "The attribute name Field is required.",
             "attribute.entity_type_id.required" =>"The attribute entity_type_id Field is required.",
             "attribute.sort_order.required" => "The attribute sort_order Field is required.",
             "attribute.input_type.required" => "The attribute input_type Field is required.",
             "attribute.label.required" => "The attribute label Field is required.",
             "attribute.placeholder.required" => "The attribute placeholder Field is required.",
             "attribute.isrequired.required" => "The attribute isrequired Field is required.",
             "attribute.status.required" => "The attribute status Field is required.",

         ]);
         if ($validator->fails()) {
             return redirect('/admin/manageform/createfields')
             ->withErrors($validator)
             ->withInput();
         }
       $entity_type_id = $request->session()->get('entity_type_id');

       $attributes= new AttributeModel;
       $entityForm = $request->get('attribute');
       $attribute = AttributeModel::where('entity_type_id',$entity_type_id)->pluck('name');
       foreach($attribute as $value)
       {
           if($entityForm['name'] === $value)
           {
            $entity_type_id = $request->session()->get('entity_type_id');

            return redirect('/admin/manageform/createfields')->withInput()->with('error','Field Name Already Exists!!');
           }

        }

       foreach ($entityForm as $key => $value) {
           $attributes->setAttribute($key,$value);
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

        $validator = Validator::make($request->all(), [
            "attribute.name" => "required",
            "attribute.entity_type_id" => "required",
            "attribute.sort_order" => "required",
            "attribute.label" => "required",
            "attribute.placeholder" => "required",
            "attribute.isrequired" => "required",
            "attribute.status" => "required",

         ],[
             "attribute.name.required" => "The attribute name Field is required.",
             "attribute.entity_type_id.required" =>"The attribute entity_type_id Field is required.",
             "attribute.sort_order.required" => "The attribute sort_order Field is required.",
             "attribute.input_type.required" => "The attribute input_type Field is required.",
             "attribute.label.required" => "The attribute label Field is required.",
             "attribute.placeholder.required" => "The attribute placeholder Field is required.",
             "attribute.isrequired.required" => "The attribute isrequired Field is required.",
             "attribute.status.required" => "The attribute status Field is required.",

         ]);
         if ($validator->fails()) {
             return redirect('/admin/manageform/editfields/'.$id)
             ->withErrors($validator)
             ->withInput();
         }
       $entity_type_id = $request->session()->get('entity_type_id');

       $attributes= new AttributeModel;
       $entityForm = $request->get('attribute');
        $attribute = AttributeModel::where('entity_type_id',$entity_type_id)->where('id','<>',$id)->pluck('name');

       foreach($attribute as $value)
       {
           if($entityForm['name'] === $value)
           {
            $entity_type_id = $request->session()->get('entity_type_id');

            return redirect('/admin/manageform/editfields/'.$id)->withInput()->with('error','Field Name Already Exists!!');
           }

        }
        AttributeModel::updateOrInsert(['id'=>$id],$entityForm);
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

        $validation =explode(";",$attribute);
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
    public function moreCustomerAction($customer_id)
    {
        $controller = $this;
        $form_id = Session::get('paginate_form_id');
        $values = Form_Values::where('form_id',$form_id)->where('customer_id',$customer_id)->get();
        $submitvalues = Form_Values::where('form_id',$form_id)->where('customer_id',$customer_id)->where('form_field_id','42')->get();
        return view('manageFormAttribute.moreCustomer',compact('form_id','controller','customer_id','values','submitvalues'));
    }
    public function customerAction($form_id)
    {
        // echo $values = Form_Values::where('form_id',$form_id)->paginate(20);
        $controller = $this;
        request()->session()->put('paginate_form_id',$form_id);
        $customers_id = Form_Values::where('form_id',$form_id)->distinct('customer_id')->pluck('customer_id');
        return view('manageFormAttribute.customer',compact('customers_id','form_id','controller'));
    }

    public function getFormField($id)
    {
        $form_id = Session::get('paginate_form_id');
        $values = Form_Values::where('form_id',$form_id)->where('customer_id',$id)->take(4)->get();
        return $values;
    }

    public function getFormName($id)
    {
        $formName = entityType::where('id',$id)->pluck('entity_name')->first();
        return $formName;

    }
    public function getCustomerName($id)
    {
           $customer = Customer::where('id',$id)->first();
           return $customer->firstname." ".$customer->lastname;
    }
    public function getFormFieldName($id)
    {
           $formField = AttributeModel::where('id',$id)->pluck('name')->first();
            return $formField;
    }

    public function getOptionName($ids)
    {
        $id = explode(',',$ids);
        $options =[];
        foreach($id as $optionid)
        {
            $optionName = OptionModel::where('id',$optionid)->pluck('name')->first();
            array_push($options,$optionName);
        }
        return implode(',',$options);
    }

    public function fetchDataAction(Request $request)
    {
        if($request->ajax())
        {
            $form_id = Session::get('paginate_form_id');
            $values = Form_Values::where('form_id',$form_id)->paginate(20);
            $controller = $this;
            return view('manageFormAttribute.customer',compact('values','form_id','controller'));
        }
    }
}
