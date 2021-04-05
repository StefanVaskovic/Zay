<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductControllerApi;
use App\Http\Controllers\Api\CategoryControllerApi;
use App\Http\Controllers\Api\SizeControllerApi;
use App\Http\Controllers\Api\CommentControllerApi;

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



    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [\App\Http\Controllers\HomeController::class,'index']);
    /*Route::get('/shop/category/{idCat?}/products', function ($idCat = 'all'){

    })->name('shopCat');*/
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product');
    Route::get('/register/create', [\App\Http\Controllers\UserController::class, 'registerForm'])->name('register.create');
    Route::get('/login/create', [\App\Http\Controllers\UserController::class, 'loginForm'])->name('login.create');
    Route::get('/getUser/{id}', [\App\Http\Controllers\UserController::class, 'getUser'])->name('user.get');
    Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register.store');
    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login.store');


    Route::resource('contact', \App\Http\Controllers\ContactController::class);


    Route::get('/cart',[\App\Http\Controllers\CartController::class,'index'])->name('cart');

    Route::middleware(['IsLoggedIn'])->group(function () {

        Route::post('/cart',[\App\Http\Controllers\CartController::class,'addToCart']);
        Route::delete('/cart/remove',[\App\Http\Controllers\CartController::class,'removeFromCart']);
        Route::post('/order',[\App\Http\Controllers\OrderController::class,'store'])->name('order.store');
        Route::post('/orderDetails',[\App\Http\Controllers\OrderController::class,'show'])->name('orderDetails.show');

        Route::get('profile',[\App\Http\Controllers\UserController::class,'edit'])->name('profileUser.edit');
        Route::put('/profile/{id}',[\App\Http\Controllers\Common\EditProfile::class,'update'])->name('profile.update');
        Route::put('/password/{id}',[\App\Http\Controllers\Common\EditProfile::class,'password'])->name('password.update');

        Route::post('/rate',[\App\Http\Controllers\UserController::class,'rate'])->name('rate.store');

        Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    });

    Route::get('/about',[\App\Http\Controllers\AboutController::class,'index'])->name('about');



    Route::get('/products/{id}',[\App\Http\Controllers\ProductController::class,'show'])->name('product');






Route::prefix('/api')->group(function ()
{
    Route::apiResource('/products',ProductControllerApi::class);
    Route::apiResource('/categories',CategoryControllerApi::class);
    Route::apiResource('/sizes',SizeControllerApi::class);
    Route::apiResource('/comments',CommentControllerApi::class);
    Route::apiResource('/mainComments',\App\Http\Controllers\Api\MainCommentControllerApi::class);
    Route::apiResource('/likes',\App\Http\Controllers\Api\LikeControllerApi::class);
});

Route::middleware(['IsAdminMiddleware'])->group(function () {
    Route::prefix('/admin')->group(function ()
    {

        Route::get('',[\App\Http\Controllers\Admin\AdminController::class,'edit'])->name('admin');
        /*Route::get('profile',[\App\Http\Controllers\Admin\AdminController::class,'edit'])->name('profile.edit');
        Route::put('/profile/{id}',[\App\Http\Controllers\Admin\AdminController::class,'update'])->name('profile.update');
        Route::put('/password/{id}',[\App\Http\Controllers\Admin\AdminController::class,'password'])->name('password.update');*/

        Route::get('profile',[\App\Http\Controllers\Admin\AdminController::class,'edit'])->name('profile.edit');


        Route::resource('menus',\App\Http\Controllers\Admin\MenuAdminController::class);
        Route::resource('orders',\App\Http\Controllers\Admin\OrderAdminController::class);
        //Route::get('orders',[\App\Http\Controllers\Admin\AdminController::class,'index'])->name('orders.index');

        Route::resource('users',\App\Http\Controllers\Admin\UserAdminController::class);
        Route::resource('brands',\App\Http\Controllers\Admin\BrandAdminController::class);
        Route::resource('activities',\App\Http\Controllers\Admin\ActivityAdminController::class);

        Route::resource('products',\App\Http\Controllers\Admin\ProductAdminController::class);
        Route::delete('/products/deleteImage/{id}',[\App\Http\Controllers\Admin\ImageAdminController::class,'deleteImage'])->name
        ('image.destroy');
        Route::put('/products/changeCover/{id}',[\App\Http\Controllers\Admin\ImageAdminController::class,'changeCover'])
            ->name('cover.update');
        Route::post('/products/addImages/{id}',[\App\Http\Controllers\Admin\ImageAdminController::class,'addImages'])->name
        ('images.store');
        Route::delete('/products/deleteAllImages/{id}',[\App\Http\Controllers\Admin\ImageAdminController::class,'deleteAllImages'])->name
        ('images.destroy');

        Route::resource('sizes',\App\Http\Controllers\Admin\SizeAdminController::class);
        Route::resource('categories',\App\Http\Controllers\Admin\CategoryAdminController::class);
        Route::resource('contacts',\App\Http\Controllers\Admin\ContactAdminController::class);

        //Route::get('contact',[\App\Http\Controllers\Admin\AdminController::class,'index'])->name('contact.index');
        Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('logoutAdmin');
        Route::delete('/comment/{id}', [\App\Http\Controllers\Admin\CommentAdminController::class, 'deleteComment'])->name('comment.destroy');
    });
});
/*Route::get('/contact',[\App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::post('/contact/submit',[\App\Http\Controllers\ContactController::class,'store'])->name('contactSubmit');*/


