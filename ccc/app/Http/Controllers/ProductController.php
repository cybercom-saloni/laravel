 <?php

// namespace App\Http\Controllers;

// use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB; -->

// class ProductController extends Controller
// {
    // public function index()
    // {
    //     $product  = Product::all();
    //     return view('product.index',['product'=>$product]);
    // }

    // public function create(Product $product)
    // {
    //     return view('product.create');
    // }

    // public function store()
    // {
    //     request()->validate([
    //         'name' => 'required',
    //         'sku' => 'required',
    //         'price'=>'required',
    //         'quantity'=>'required',
    //         'discount'=>'required',
    //         'description'=>'required',
    //         'status'=>'required',
    //     ]);

    //     Product::create([
    //         'sku'=>request('sku'),
    //         'name'=>request('name'),
    //         'price'=>request('price'),
    //         'quantity'=>request('quantity'),
    //         'discount'=>request('discount'),
    //         'description'=>request('description'),
    //         'status'=>request('status'),

    //     ]);
    //     return redirect('/product');
    // }

    // public function edit(Product $product)
    // {
    //     return view('product.edit',['product'=>$product]);
    // }

    // public function update(Product $product)
    // {
    //     request()->validate([
    //         'name' => 'required',
    //         'sku' => 'required',
    //         'price'=>'required',
    //         'quantity'=>'required',
    //         'discount'=>'required',
    //         'description'=>'required',
    //         'status'=>'required',
    //     ]);

    //     $product->update([
    //         'sku'=>request('sku'),
    //         'name'=>request('name'),
    //         'price'=>request('price'),
    //         'quantity'=>request('quantity'),
    //         'discount'=>request('discount'),
    //         'description'=>request('description'),
    //         'status'=>request('status'),
    //     ]);

    //     return redirect('/product');
    // }

    // public function destroy(Product $product)
    // {
    //    $product->delete();
    //    return redirect('/product');
    // }
// }
