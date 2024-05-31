<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;



/* Public side*/
Route::post('/login', [AuthController::class ,"login"])->name("login");
Route::post('/register', [AuthController::class ,"register"])->name("register");
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);


// /* Protected side*/
Route::group(["middleware"  => ['auth:sanctum']], function () {
    Route::get("/products",[ProductController::class,"index"])->name("product.index");
    Route::post("/products",[ProductController::class,"store"])->name("product.store");
    Route::get("/products/{id}",[ProductController::class,"show"])->name("product.show");
    Route::put("/products/{id}",[ProductController::class,"update"])->name("product.update");
    Route::delete("/products/{id}",[ProductController::class,"destroy"])->name("product.destroy");
    Route::post('/logout', [AuthController::class ,"logout"])->name("logout");
});


