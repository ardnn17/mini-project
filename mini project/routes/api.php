<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\LikeController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route for authentication
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


// Route For Admin
Route::middleware(['auth:api','ceklevel:admin'])->group(function () {
    // Route For Category
    Route::post('/create-category',[CategoryController::class,'create']);
    Route::post('/jumlah-category',[CategoryController::class,'jumlahCategory']);
    Route::post('/delete-category/{id}',[CategoryController::class,'DelCategory']);

    // Route RD
    Route::post('/show-all',[AdminPageController::class,'showAll']);
    Route::post('/delete-post/{id}',[AdminPageController::class,'deletePost']);
    Route::post('/post-count',[PostController::class,'postCount']);

    // Route cek user
    Route::post('/admin_page',[AuthController::class,'admin']);
    Route::post('/all-user',[AuthController::class,'allUser']);
    Route::post('/jumlah-user',[AuthController::class,'jumlahUser']);
    Route::post('/delete-user/{id}',[AuthController::class,'delete']);
});







// Route For User
Route::middleware(['auth:api','ceklevel:user,admin'])->group(function () {
    // Route CRUD
    Route::post('/create',[PostController::class,'create']);
    Route::post('/dashboard',[PostController::class,'dashboard']);
    Route::post('/profile',[PostController::class,'profile']);
    Route::post('/user',[PostController::class,'detailUser']);
    Route::post('/detail-post/{id}',[PostController::class,'detailPost']);
    Route::post('/edit/{id}',[PostController::class,'edit']);
    Route::post('/delete/{id}',[PostController::class,'delete']);

    // Route For Auth
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/edit-username',[AuthController::class,'editUsername']);

    // Route For Category
    Route::post('/categories',[CategoryController::class,'categories']);
    Route::post('/show-category/{id}',[CategoryController::class,'ShowCategory']);

    // Route Profile
    Route::post('/add-photo-profile',[ProfileController::class,'addPhoto']);
    Route::post('/delete-photo-profile',[ProfileController::class,'deletePhoto']);

    // Like Post
    Route::post('post/like/{id}',[LikeController::class,'likePost']);
});
