<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Product\MediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product;
use App\Http\Controllers\Product\Media;
use App\Http\Controllers\Category;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Customer\Address;
use App\Http\Controllers\NewDashboard;
use App\Http\Controllers\Cart;
use App\Http\Controllers\Cart\CartItem;
use App\Http\Controllers\Cart\Address as CartAddress;
use App\Http\Controllers\Order;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test',function ()
{
    return App\Models\Category::with('child')->where('parent_id',0)->get();
});



Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{post}/edit',[PostController::class,'edit']);
Route::get('/posts',[PostController::class,'store']);
Route::get('/posts/create',[PostController::class,'create']);
Route::put('/posts/{post}',[PostController::class,'update']);
Route::get('/admin/product',[ProductController::class,'index']);
Route::get('/admin/product/create',[ProductController::class,'create']);
Route::post('/admin/product',[ProductController::class,'store']);
Route::get('/admin/product/{product}/edit',[ProductController::class,'edit']);
Route::put('/admin/product/{product}',[ProductController::class,'update']);
Route::delete('/admin/product/{product}',[ProductController::class,'destroy']);
Route::get('/admin/product/{product}',[ProductController::class,'destroy']);
Route::get('/admin/product/media/{product}',[MediaController::class,'index']);
Route::post('/admin/product/media/{id}',[MediaController::class,'imageUpload'])->whereNumber('id');
Route::get('/admin/product/media',[MediaController::class,'update']);
Route::get('/admin/category',[CategoryController::class,'index']);
Route::get('/admin/category/create',[CategoryController::class,'create']);
Route::get('/admin/category/selectPath',[CategoryController::class,'selectPath']);
Route::post('/admin/product/media/imageUpload/{id}', [MediaController::class, 'saveAction'])->whereNumber('id');
Route::post('/admin/product/media/mediaUpdate', [MediaController::class, 'updateAction']);


//laravel start
Route::get('/product', [Product::class, 'gridAction'])->name('productGrid');
Route::post('/productSave/{id?}', [Product::class, 'saveAction'])->whereNumber('id')->name('productSave');
Route::get('/productDelete/{id?}', [Product::class, 'deleteAction'])->whereNumber('id');
Route::get('/product/form/{id?}', [Product::class, 'formAction'])->whereNumber('id')->name('productForm');
Route::get('/product/media/{id?}', [Product::class, 'mediaAction'])->whereNumber('id');
Route::post('/product/imageUpload/{id}', [Media::class, 'saveAction'])->whereNumber('id');
Route::post('/media/update/{id}', [Media::class,'productUpdateAction']);
Route::post('/media/delete/{id?}', [Media::class, 'deleteAction'])->whereNumber('id');
Route::get('product/status/{id}', [Product::class, 'productStatusAction']);
Route::get('/product/fetch_data',[Product::class,'fetch_data']);
// Route::get('product/',[Product::class,'fetch_data']);

//category
Route::get('/category/{id}',[Category::class,'gridAction'])->name('categoryEdit');
Route::get('/categoryDelete/{id}', [Category::class, 'deleteAction'])->name('categoryDelete');
Route::get('/categorEditSave/{id}',[Category::class,'editSaveAction'])->name('categorEditSave');
Route::get('/categoryAddSubCategory/{id}',[Category::class,'addSubCategoryAction'])->name('addSubCategory');
Route::get('/addRootCategory',[Category::class,'addRootCategoryAction'])->name('addnewRootCategory');
Route::get('/rootCategoryEditSave',[Category::class,'rootCategoryEditSave'])->name('addRootCategory');
// Route::get('/categoryAddnewSubCategory/{$id}',function($id)
// {
//     return $id;
// });
Route::get('/tree',[Category::class,'treeAction'])->name('tree');
Route::get('/categoryAddnewSubCategory/{id}',[Category::class,'addnewSubCategory'])->name('addnewSubCategoryAction');
Route::get('/dashboard',[NewDashboard::class,'dashboardAction'])->name('dashboard');

//customer
Route::get('/customerGrid',[Customer::class,'gridAction'])->name('customerGrid');
Route::get('/customer/form/{id?}',[Customer::class,'formAction'])->whereNumber('id');
Route::get('customer/status/{id}', [Customer::class, 'customerStatusAction']);
Route::get('/customerDelete/{id?}', [Customer::class, 'deleteAction'])->whereNumber('id');
Route::post('/customer/save/{id?}',[Customer::class,'saveAction'])->whereNumber('id');

//customerAddress
Route::get('/customer/addressform/{id}',[Address::class,'formAction'])->whereNumber('id');
Route::post('/customerAdress/save/{customerId}',[Address::class,'saveAction'])->whereNumber('id');
Route::get('/customerGrid/fetch_data',[Customer::class,'fetch_data']);
//cart
Route::get('/cart/{id?}',[Cart::class,'addToCartAction'])->whereNumber('id')->name('cart');
Route::post('/cart/customer',[Cart::class,'saveCustomerAction']);
Route::post('/cart/customer/addressSave/{id?}',[CartAddress::class,'AddressAction'])->whereNumber('id');
Route::post('/cartItem/update',[CartItem::class,'ItemAction']);
Route::get('/cartItem/delete/{id}',[CartItem::class,'ItemDeleteAction']);
Route::get('/cartproduct/fetch_cartdata',[Cart::class,'fetch_cartdata']);
Route::post('/cartItem/addItem',[CartItem::class,'addItemAction']);

Route::get('/order',[Order::class,'displayOrderAction']);
Route::get('/order/Information/{id?}',[Order::class,'displayAllOrderAction']);
Route::post('/order/customer',[Order::class,'saveCustomerAction']);

Route::post('/saveStatus',[Order::class,'saveStatusAction']);