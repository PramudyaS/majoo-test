<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'],function(){
   Route::get('product_category/{id}',\App\Http\Controllers\API\ProductCategory\GetProductCategory::class)->name('api.product_category.show');
   Route::post('upload_image',\App\Http\Controllers\API\Upload\UploadImageController::class)->name('api.upload_image');
});
