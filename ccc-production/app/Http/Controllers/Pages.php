<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Attribute\Option;
use App\Models\entityType;
use Illuminate\Support\Facades\Session;


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

        $validation =explode(",",$attribute);
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
}
