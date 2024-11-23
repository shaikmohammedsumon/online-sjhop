<?php

use App\Http\Controllers\AddToCartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\GestAuthController;
use App\Http\Controllers\RoleManagementController;
// use App\Http\Controllers\CheckoutAndCartController;
use App\Http\Controllers\Frontend\FroentendController;
use App\Http\Controllers\Frontend\ShopDetailsController;
use App\Http\Controllers\OrderProductController;

// Route::get('/', function () {
//     return view('welcome');
// });



//Froentend
Route::get('/',[FroentendController::class,'index'])->name('froentend.index');
Route::get('/all/product',[FroentendController::class,'all_product'])->name(name: 'froentend.all.product');
Route::get('/category/product/{title}',[FroentendController::class,'category_product'])->name('froentend.category.product');

Route::get('/shop',[ShopDetailsController::class,'shop'])->name('shop.index');
Route::get('/shop/category/{category}',[ShopDetailsController::class,'shop_category'])->name('shop.category');
Route::post('/shop/fruitlist',[ShopDetailsController::class,'fruitlist'])->name('shop.fruitlist');
Route::get('/shop/price',[ShopDetailsController::class,'shop_price'])->name('shop.price');
Route::get('/products/section/{section}',[ShopDetailsController::class,'product_section'])->name('product.section');

Route::get('/shop/deleils/{id}',[ShopDetailsController::class,'index'])->name('shop.details');

//cart
Route::middleware(['gestuserpermission'])->group(function (){
    Route::get('/cart',[CartController::class,'cart_view'])->name('cart.index');
    Route::get('user/profile',[GestAuthController::class,'profile'])->name('gest.profile');
    Route::get('/user/buy/now/product/{id}',[AddToCartController::class,'store'])->name('user.buy.product');
    Route::get('user/cart/buy/product/delete/{id}',[CartController::class,'delete'])->name('user.cart.buy.producd.delete');
    Route::get('user/cart/buy/product/quantity/up/{id}',[CartController::class,'quantityUp'])->name('user.cart.buy.producd.quantity.up');
    Route::get('user/cart/buy/product/quantity/down/{id}',[CartController::class,'quantityDown'])->name('user.cart.buy.producd.quantity.down');

    //checkout
    Route::get('/checkout/product',[CheckoutController::class,'index'])->name('checkout.index');
    Route::post('/checkout/confirm/product',[CheckoutController::class,'store'])->name('chechout.confirm.product');
});


Route::middleware(['gestauthuserpermission'])->group(function (){

    Route::get('user/register',[GestAuthController::class,'registe'])->name('gest.register');
    Route::post('user/register',[GestAuthController::class,'registe_post'])->name('gest.register');

    Route::get('user/login',[GestAuthController::class,'login'])->name('gest.login');
    Route::post('user/login',[GestAuthController::class,'login_post'])->name('gest.login');

});







//Authencation
Auth::routes(['register' =>false]);

Route::middleware(['dashboardRoleCheckMiddleware'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //user
    Route::get('/profile',[UserController::class,'view'])->name('pforile.update');
    Route::post('/profile/name/update',[UserController::class,'name_update'])->name('pforile.name.update');
    Route::post('/profile/password/update',[UserController::class,'password_update'])->name('pforile.password.update');
    Route::post('/profile/image/update',[UserController::class,'image_update'])->name('pforile.image.update');



    //Categoris
    Route::get('/category/index',[CategoryController::class,'index'])->name('category.index');
    Route::post('/category/created',[CategoryController::class,'created'])->name('category.created');
    Route::get('/category/action/{slug}',[CategoryController::class,'action'])->name('category.action');
    Route::get('/category/edit/{slug}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/category/update/{slug}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/category/delete/{slug}',[CategoryController::class,'delete'])->name('category.delete');

    //Product
    Route::resource('/products',ProductController::class);
    Route::get('/product/action/{name}',[ProductController::class,'action'])->name('product.action');
    Route::get('/product/fresh/organic/vegetables/{name}',[ProductController::class,'organic'])->name('product.fresh.organic.vegetables');
    Route::post('/products/category/{id}',[ProductController::class,'product_category'])->name('product.category');


    //Order Product
    Route::get('/new.order.by.product',[OrderProductController::class,'index'])->name('new.order.product');

});

Route::middleware(['adminRoleCheckMiddleware'])->group(function(){
    //role Management
    Route::get('/manager/details',[RoleManagementController::class,'manager_index'])->name('manager.details');
    Route::post('/manager/role/{id}',[RoleManagementController::class,'manager_role'])->name('manager.role');

    Route::get('/seller/details',[RoleManagementController::class,'seller_index'])->name('seller.details');
    Route::post('/seller/role/{id}',[RoleManagementController::class,'seller_role'])->name('seller.role');

    Route::get('/user/details',[RoleManagementController::class,'index'])->name('user.details');
    Route::post('/user/role/{id}',[RoleManagementController::class,'user_role'])->name('user.role');
});



