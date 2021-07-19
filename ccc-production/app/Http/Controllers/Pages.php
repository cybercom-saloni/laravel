<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Attribute\Option;
use App\Models\entityType;
use Illuminate\Support\Facades\Session;
use App\Models\Form_Values;
use Illuminate\Support\Facades\Validator;

class Pages extends Controller
{

    public function slugAction($slug =null)
    {
        if(!Session::has('loginid'))
        {
            return redirect('/user/login')->with('error','Please Login first');

        }
        if(!$slug)
        {
            return redirect('user/login')->with('success','error..');
        }
        $entity = entityType::where('slug',$slug)->first();

         $attribute = Attribute::where([['entity_type_id',$entity->id],['status',1]])->orderBy('sort_order')->get();
         $controller = $this;
         return view('frontend.slug',compact('attribute','controller','entity'));


    }
    public function showSlug()
    {
        if(!Session::has('loginid'))
        {
            return redirect('/user/login')->with('error','Please Login first');

        }
        $entity = entityType::where('status',1)->get();
       return $entity;
    }
    public function getOptions($id)
    {
       $options = Option::where([['attribute_id',$id],['status',1]])->orderBy('sort_order')->get();
       return $options;

    }

    public function getValidation($id,$entityid)
    {
        $attribute = Attribute::where([['entity_type_id',$entityid],['id',$id],['status',1]])->orderBy('sort_order')->pluck('validation')->first();

        $validation =explode(";",$attribute);
        $attribute =implode(" ",$validation);
       return $attribute;

    }
    public function getStyle($id,$entityid)
    {
        $attribute = Attribute::where([['entity_type_id',$entityid],['id',$id],['status',1]])->orderBy('sort_order')->pluck('style')->first();
        $validation =explode(",",$attribute);
        $attribute =implode(";",$validation);
       return $attribute;
    }

    public function saveFormAction($form_id,Request $request)
    {
        $customer_id = Session::has('loginid');
        $formfields = Attribute::where('entity_type_id',$form_id)->where('status',1)->orderBy('sort_order')->get();

        $formValues = $request->all();
        echo "<pre>";
        // print_r($formValues);
        foreach($formfields as $value)
        {
            $name = $value->name;
            $file = Attribute::where('name',$name)->first();
            // print_r($file);
            $input_type = $file['input_type'];
            $file_type = $file['file_type'];
            $file_type = explode(";",$file_type);
            $file_type = implode("|",$file_type);
            $backend_validation = $file['backend_validation'];
            $backend_validation = explode(";",$backend_validation);
            echo $backend_validation = implode("|",$backend_validation);
            $validation = $file_type."|".$backend_validation;
            if($input_type == 'file')
            {

                if($request->hasFile($name))
                {
                    $file= $request->hasFile($name);

                    foreach($request->$name as $part) {
                         $validator = Validator::make($request->all(), [
                            $name.".*" => $backend_validation,
                        ]);
                         if ($validator->fails()) {

                             return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
                            }
                        $filename = $part->getClientOriginalName();
                        $image = getimagesize($part);
                        echo $file_type;
                        echo$type = $part->getClientMimeType();

                    }
                }

            }
            foreach($formValues as $key =>$values)
            {
                if($key == $name)
                {
                    if($keys= array_values($formValues))
                    {
                        if(is_array($values))
                        {
                            if($request->hasFile($key))
                            {
                                $file= $request->hasFile($key);


                                foreach($request->$key as $part) {
                                    $filename = $part->getClientOriginalName();
                                    $image = getimagesize($part);
                                    $type = $part->getClientMimeType();

                                    if($type == "image/jpeg" || $type =="image/png" || $type == "image/svg" || $type == "image/gif")
                                    {
                                        $imageWidth = $image[0];
                                        $imageHeight = $image[1];
                                        $mime = $image['mime'];
                                        $part->move(public_path("frontend/images"), $filename);
                                    }
                                    else
                                    {
                                        $part->move(public_path("frontend/files/"), $filename);

                                    }
                                    $formsave = new Form_Values();
                                    $formsave->insert([
                                        "customer_id"=>$customer_id,
                                        "form_id"=>$form_id,
                                        "form_field_id"=>$value->id,
                                        "input_values" =>$filename
                                    ]);

                                }
                            }
                            else
                            {
                                $form= implode(",",$values);
                                $formsave = new Form_Values();
                                $formsave->insert([
                                    "customer_id"=>$customer_id,
                                    "form_id"=>$form_id,
                                    "form_field_id"=>$value->id,
                                    "option_id" =>$form
                                ]);

                            }

                        }

                        else
                        {
                            $formsave = new Form_Values();
                            // $value->id;
                            $form_input_type = Attribute::where('id',$value->id)->first();
                            if($form_input_type['input_type'] == 'password')
                            {
                                $validator = Validator::make($request->all(), [
                                    $name => [
                                        'required',
                                        'min: 8',
                                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                                        'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                        'regex:/[0-9]/',      // must contain at least one digit
                                        'regex:/[@$!%*#?&]/', // must contain a special character

                                    ],[
                                        $name => 'The password must contains at least one number,one captial letter,one small letter,one special symbol',
                                    ]
                                ]);
                                 if ($validator->fails()) {
                                     return redirect()->back()
                                     ->withErrors($validator)
                                     ->withInput();
                                    }
                                $values =  hash('sha256',$values);
                            }

                            $formsave->insert([
                                "customer_id"=>$customer_id,
                                "form_id"=>$form_id,
                                "form_field_id"=>$value->id,
                                "input_values" =>$values
                            ]);

                        }
                    }
                }
            }
        }
        return redirect()->back()->with('success','form value saved!!');
    }
}
