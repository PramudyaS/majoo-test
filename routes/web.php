<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\ProductCategory;
use App\Http\Controllers\Product;

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

Route::group(['prefix'=>'admin','as'=>'admin.'],function(){

    Route::post('login',[Auth\LoginController::class,'login'])->name('login');
    Route::get('login',[Auth\LoginController::class,'showLoginForm'])->name('login_form');
    Route::post('logout',[Auth\LoginController::class,'logout'])->name('logout');


   Route::group(['middleware'=>'auth'],function(){
       Route::get('/',function(){
           return view('layouts.layout');
       })->name('dashboard');

       Route::resource('product_category',ProductCategory\ProductCategoryController::class);
       Route::resource('product',Product\ProductController::class);
   });

});


Route::get('/',\App\Http\Controllers\LandingPageController::class)->name('landing_page');



