<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\User\AuthController as UserAuthController;
use App\Http\Controllers\Api\OwnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Some Middlewares + get By Admins
Route::middleware(['check-password','check-language','jwt.admins:admins'])->group(function () {
    Route::get('/owners',[OwnerController::class,'index']);
    Route::get('/clothes',[OwnerController::class,'getCategories']);
});

//get By Users
Route::middleware(['jwt.users:users'])->group(function () {
    Route::get('/users',[OwnerController::class,'getUsers']);
});

################## Admin Auth ################################
Route::post('/admin/login',[AuthController::class,'adminLogin']);

Route::middleware(['jwt.admins:admins'])->group(function () {

    Route::post('/admin/get-me',[AuthController::class,'me']);
    Route::post('/admin/refresh-token',[AuthController::class,'refresh']);
    Route::get('/admin/hello-admin',[AuthController::class,'sayHello']);
    Route::post('/admin/logout',[AuthController::class,'adminLogout']);

});

################## User Auth ################################
Route::post('/user/login',[UserAuthController::class,'userLogin']);

Route::middleware(['jwt.users:users'])->group(function () {

    Route::post('/user/get-me',[UserAuthController::class,'me']);
    Route::post('/user/refresh-token',[UserAuthController::class,'refresh']);
    Route::get('/user/hello-user',[UserAuthController::class,'sayHello']);
    Route::post('/user/logout',[UserAuthController::class,'userLogout']);

});
