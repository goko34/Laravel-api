<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontAuthController;
use App\Http\Controllers\FrontProductController;


/* Auth side*/
Route::get('/', function () {return view('auths.register');});
Route::get('/login', [FrontAuthController::class ,"login"])->name("login");
Route::get('/register', [FrontAuthController::class ,"register"])->name("register");
Route::post('/register', [FrontAuthController::class ,"postRegister"])->name("register.post");
Route::post('/login', [FrontAuthController::class ,"postLogin"])->name("login.post");
Route::get('/logout', [FrontAuthController::class ,"logout"])->name("logout");


/* Products side*/

Route::get('/products', [FrontProductController::class, 'home'])->name('products.home');
Route::get('/products/create', [FrontProductController::class, 'create'])->name('products.create');
Route::post('/products/create', [FrontProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/detail', [FrontProductController::class, 'detail'])->name('products.detail');
Route::get('/products/{id}', [FrontProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [FrontProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}/destroy', [FrontProductController::class, 'destroy'])->name('products.destroy');

