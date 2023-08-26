<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CateygoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Admin dashboard
Route::group(['middleware' =>'preventBackHistory'],function(){

    Route::group(['prefix'=>'admin/', 'middleware'=>'auth' ],function(){
            Route::get('/',[AdminController::class,'admin'])->name('admin');
 
            //Banner Section
            Route::resource('banner', BannerController::class);
            Route::post('/update-banner-status', BannerController::class)->name('update.banner.status');

            //Category Section
            Route::resource('category', CateygoryController::class);
            Route::post('/update-category-status', CateygoryController::class)->name('update.category.status');

            Route::post('/category/{id}/child', [App\Http\Controllers\Admin\CateygoryController::class, 'getChildByParentID']);

            //Brand Section
            Route::resource('brand', BrandController::class);
            Route::post('/update-brand-status', BrandController::class)->name('update.brand.status');

            //product Section
            Route::resource('product', ProductController::class);
            Route::post('/update-product-status', ProductController::class)->name('update.product.status');

            // User Section
            Route::resource('user', UserController::class);
            Route::post('/update-user-status', UserController::class)->name('update.user.status');


    });
});