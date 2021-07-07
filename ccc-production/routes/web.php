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
use App\Http\Controllers\OrderStatus;
use App\Http\Controllers\Payment;
use App\Http\Controllers\Shipping;
use App\Http\Controllers\Product\ImportExportCsv;
use App\Http\Controllers\ProductImport;
use App\Http\Controllers\Comment;
use App\Http\Controllers\Salesman;
use App\Http\Controllers\UserLogin;
use App\Http\Middleware\CheckUserLoginStatus;
use App\Http\Controllers\Website;

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


//middleware
// Route::get('/posts',[PostController::class,'index']);// global
//group
// Route::group(['middleware'=>['name']],function()
// {
//     Route::get('/posts',[PostController::class,'index']);
// });
// Route::middleware([name::class])->group(function () {
//     });
// Route::middleware(['name'])->group(function () {
//     Route::get('/posts',[PostController::class,'index']);
// });
Route::middleware([check::class])->group(function(){
    Route::get('/posts', [PostController::class,'index']);
});
Route::get('/posts', [PostController::class,'index']);
// Route::get('/posts',[PostController::class,'index'])->middleware('name');
// Route::view('users','user');
Route::view('error','error');
Route::view('home','home');
Route::group(['middleware' =>['page']],function(){
    Route::view('user','user');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('test',function ()
{
    return App\Models\Category::with('child')->where('parent_id',0)->get();
});

Route::get('/posts/middleware',[PostController::class,'middlewareAction']);
Route::get('/comment',[Comment::class,'index']);
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{post}/edit',[PostController::class,'edit']);
// Route::get('/posts',[PostController::class,'store']);
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


//laravel project start
Route::post('/custom-login', [UserLogin::class, 'customLogin'])->name('login.custom');
Route::get('/custom-logout', [UserLogin::class, 'customLogout'])->name('logout.custom');
Route::get('/dashboard', [UserLogin::class,'dashboard']);
Route::get('/products/{orderBy?}/{orderDirection?}', [Product::class, 'gridAction'])->name('productGrid');
Route::post('/productSave/{id?}', [Product::class, 'saveAction'])->whereNumber('id')->name('productSave');
Route::get('/productDelete/{id?}', [Product::class, 'deleteAction'])->whereNumber('id');
Route::get('/productCacheDelete/{id?}', [Product::class, 'deleteCacheAction'])->whereNumber('id');
Route::get('/productCacheDeleteGrid', [Product::class, 'deleteCacheGridAction']);
Route::get('/product/create/{id?}', [Product::class, 'formAction'])->whereNumber('id')->name('productForm');
Route::get('/product/edit/{id?}', [Product::class, 'editFormAction'])->whereNumber('id')->name('productEdit')->missing(fn($request)=>response()->view('welcome'));
// Route::get('/locations/{location:slug}', [LocationsController::class, 'show'])
//     ->name('locations.view')
//     ->missing(fn($request) => Redirect::route('locations.index', null, 301));
Route::get('/product/media/{id?}', [Product::class, 'mediaAction'])->whereNumber('id');
Route::post('/product/imageUpload/{id}', [Media::class, 'saveAction'])->whereNumber('id');
Route::post('/media/update/{id}', [Media::class,'productUpdateAction']);
Route::post('/media/delete/{id?}', [Media::class, 'deleteAction'])->whereNumber('id');
Route::get('product/status/{id}', [Product::class, 'productStatusAction']);
Route::get('productdelete/status/{id}', [Product::class, 'productDeleteStatusAction']);
Route::get('/product/fetch_data',[Product::class,'fetch_data']);
Route::get('students/list', [Product::class, 'getStudents'])->name('students.list');
Route::post('/search/productId', [Product::class, 'searchIdAction']);
Route::get('/tree',[Category::class,'treeAction'])->name('tree');



Route::prefix('category')->group(function () {
    Route::get('export', [Category::class, 'exportCsv'])->name('category.export');
    Route::post('import', [Category::class, 'importCsv'])->name('category.import');
    Route::get('download', [Category::class, 'downloadExample'])->name('category.download');
});

Route::get('/categories/{id?}/{type?}', [Category::class, 'gridAction'])->name('formEdit');
Route::post('/saveCategories/{id?}/{type?}', [Category::class, 'saveAction'])->name('saveCategory');
Route::get('/deleteCategories/{id}', [Category::class, 'deleteAction'])->name('deleteCategory');
Route::post('category-subcategory/save-nested-categories', [Category::class,'saveNestedCategories'])->name('category-subcategory.save-nested-categories');
// Route::get('/category/{id?}', [Category::class, 'gridAction'])->name('formEdit');

Route::post('/addCategory/{id?}',[Category::class,'addAction'])->name('addRoot');

// Route::post('/updateCategory/{id}', [Category::class, 'updateAction'])->name('updateCategory');

// Route::post('/deleteCategory/{id?}', [Category::class, 'deleteAction'])->name('deleteCategory');

// Route::get('/categoryAddnewSubCategory/{id}',[Category::class,'addnewSubCategory'])->name('addnewSubCategoryAction');
// Route::get('/dashboard',[NewDashboard::class,'dashboardAction'])->name('dashboard');

//customer
Route::get('/customerGrid',[Customer::class,'gridAction'])->name('customerGrid');
Route::get('/customer/form/{id?}',[Customer::class,'formAction'])->whereNumber('id');
Route::get('customer/status/{id}', [Customer::class, 'customerStatusAction']);
Route::get('/customerDelete/{id?}', [Customer::class, 'deleteAction'])->whereNumber('id');
Route::post('/customer/save/{id?}',[Customer::class,'saveAction'])->whereNumber('id');
Route::post('/customer/customerId', [Customer::class, 'searchIdAction']);
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

Route::get('/order/{id?}',[Order::class,'displayOrderAction']);
Route::get('/InformationCustomer/{id?}',[Order::class,'displayAllOrderAction']);
Route::get('/manageOrder',[Order::class,'manageOrderAction'])->name('manageOrder');
Route::post('/order/customer',[Order::class,'saveCustomerAction']);

Route::post('/setPages/{page?}', [Product::class, 'setPageAction'])->name('setProductPage');


Route::post('/InformationCustomer/saveComment/{id}', [OrderStatus::class, 'saveComment'])->name('saveComment');

Route::get('/payment',[Payment::class,'gridAction'])->name('payment');
Route::post('/paymentSave/{id?}', [Payment::class, 'saveAction'])->whereNumber('id')->name('PaymentSave');
Route::get('/paymentDelete/{id?}', [Payment::class, 'deleteAction'])->whereNumber('id');
Route::get('/payment/form/{id?}', [Payment::class, 'formAction'])->whereNumber('id')->name('paymentForm');
Route::get('payment/status/{id}', [Payment::class, 'StatusAction']);

Route::get('/shipment',[Shipping::class,'gridAction'])->name('shipment');
Route::post('/shippingSave/{id?}', [Shipping::class, 'saveAction'])->whereNumber('id')->name('shippingSave');
Route::get('/shippingDelete/{id?}', [Shipping::class, 'deleteAction'])->whereNumber('id');
Route::get('/shipping/form/{id?}', [Shipping::class, 'formAction'])->whereNumber('id')->name('shippingForm');
Route::get('shipping/status/{id}', [Shipping::class, 'StatusAction']);

Route::get('/exportCsv',[ImportExportCsv::class,'exportCsvAction']);
Route::post('/importCsv',[ImportExportCsv::class,'importCsvAction']);
Route::get('/csv/grid',[ImportExportCsv::class,'gridAction']);


//importExport excel laravel maatwebsite
Route::get('file', [Product::class, 'fileImportExport']);
Route::post('/importExcelCsv', [Product::class, 'fileImport'])->name('importExcelCsv');
Route::get('/exportExcelCsv', [Product::class, 'fileExport'])->name('exportExcelCsv');


//salesman
Route::get('/salesmanGrid/{id?}',[Salesman::class,'gridAction']);
Route::post('/salesmanGrid/searchSalesman',[Salesman::class,'gridAction']);
// Route::get('/salesmanGrid/gridActionClear',[Salesman::class,'gridActionClear']);
Route::get('gridActionClear', 'App\Http\Controllers\Salesman@clearAction');
Route::post('/salesmanAddPrice/{id}',[Salesman::class,'addPriceAction'])->name('salesmanAddPrice');
Route::post('/salesmanUpdatePrice/{id}',[Salesman::class,'updatePriceAction'])->name('salesmanUpdatePrice');
Route::post('/salesmanAdd/{id?}',[Salesman::class,'addAction']);
Route::post('/searchSalesman',[Salesman::class,'searchSalesmanAction']);
Route::get('/SalesmanPrice/{id?}',[Salesman::class,'showPriceAction'])->name('SalesmanPrice');
Route::get('/SalesmanPrice/salesman/{id?}',[Salesman::class,'showPriceAction2']);
Route::post('/SalesmanPrice/new/{id?}',[Salesman::class,'showPriceAction']);
Route::get('/salesmanDelete/{id}',[Salesman::class,'deleteAction'])->name('salesmandelete');
Route::get('/salesmanClear',[Salesman::class,'clearAction']);
Route::post('/SalesmanAddNewProduct/{id?}',[Salesman::class,'SalesmanAddNewProductAction']);

// Front-End
Route::get('/user/login', [UserLogin::class,'userLoginAction']);
Route::post('/user/checkLogin', [UserLogin::class,'checkLoginAction'])->name('login.check');
Route::get('/user/signup', [UserLogin::class,'signupAction'])->name('signup');
Route::get('/user/newlogin/{id}', [UserLogin::class,'loginProcessAction']);
Route::post('/user/save',[Customer::class,'saveUserAction']);


Route::get('/mail',[Website::class,'index']);







// Route::prefix('user')->middleware([CheckUserLoginStatus::class])->group(function(){
//     Route::post('/checkLogin', [UserLogin::class,'checkLoginAction'])->name('login.check');
//  });












































// Route::match(['get','post','put','delete','patch'],'{controller}/{function?}',function($controller='index',$function='index'){
//     $controller = 'App\Http\Controllers\\'.ucfirst($controller);
//     $controller = new $controller;

//     return $controller->{$function."Action"}();
// });
