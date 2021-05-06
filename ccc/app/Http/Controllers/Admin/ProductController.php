<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product\Media;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        
        $product  = Product::all();
        return view('admin.product.index',['product'=>$product]);
    }

    public function create(Product $product)
    {
        return view('admin.product.create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'sku' => 'required',
            'price'=>'required',
            'quantity'=>'required',
            'discount'=>'required',
            'description'=>'required',
            'status'=>'required',
        ]);

        Product::create([
            'sku'=>request('sku'),
            'name'=>request('name'),
            'price'=>request('price'),
            'quantity'=>request('quantity'),
            'discount'=>request('discount'),
            'description'=>request('description'),
            'status'=>request('status'),

        ]);
        return redirect('/admin/product');
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit',['product'=>$product]);
    }

    public function update(Product $product)
    {
        request()->validate([
            'name' => 'required',
            'sku' => 'required',
            'price'=>'required',
            'quantity'=>'required',
            'discount'=>'required',
            'description'=>'required',
            'status'=>'required',
        ]);

        $product->update([
            'sku'=>request('sku'),
            'name'=>request('name'),
            'price'=>request('price'),
            'quantity'=>request('quantity'),
            'discount'=>request('discount'),
            'description'=>request('description'),
            'status'=>request('status'),
        ]);

        return redirect('/admin/product');
    }

    public function destroy(Product $product)
    {
       $product->delete();
       return redirect('/admin/product');
    }

    public function media(Product $product)
    {
        $medias = Media::all();
        return view('admin.product.media',['product'=>$product]);
    }
    public function imageUpload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
      $imageName = time().'.'.$request->image->extension();  
      $photo = $_FILES['image']['name']; 
      $request->image->move(public_path('images'), $photo);
      Media::create(['media'=>$photo]);
      return view('admin.product.media',['product'=>$request]);
    }
    // public function getStatusOptions()
	// {
	// 	$status=[
	// 		'disabled'=>"Disabled",
	// 		'enabled'=>"Enabled"
	// 	];
    //     return View::make('admin/product/create')->with($data);
	// }
}
