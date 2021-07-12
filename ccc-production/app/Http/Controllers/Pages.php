<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Attribute\Option;
use App\Models\entityType;

class Pages extends Controller
{
    public function contactusAction()
    {
        $attribute = Attribute::where([['entity_type_id','6'],['status',1]])->orderBy('sort_order')->get();
        $controller = $this;
        return view('frontend.contactus',compact('attribute','controller'));

    }

    public function slugAction($slug =null)
    {
        echo $entity = entityType::where('status',1)->get();

    }
    public function getOptions($id)
    {
       $options = Option::where([['attribute_id',$id],['status',1]])->orderBy('sort_order')->get();
       return $options;

    }
}
