<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Media;

class MediaController extends Controller
{
    public function index($product)
    {
        $media = Media::where('product_id',$product)->get();
        return view('admin.product.media',['media'=>$media]);
    }

    public function imageUpload($id,Request $request)
    {
        $product_id = $request->value;
        if($request->hasFile('image'))
        {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
      
          $imageNames = time().'.'.$request->image->extension();  
          $imageName = $_FILES['image']['name']; 
          $request->image->move(public_path('images/admin/product'), $imageName);
          $mediaData =[
            'media'=>$imageName,
            'product_id'=>$product_id
          ];
          Media::create(['media'=>$photo,
          'product_id'=>$product_id]);
        }
       return redirect('/admin/product/media/.'.$product_id);
    }

    public function update(Media $media)
    {
        echo 1233;
    }
}
