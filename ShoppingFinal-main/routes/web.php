<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PdfController;

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

// Route::get('/', function () {
//     return view('home');
// });
// client controller
Route::get('/', [ClientController::class,'home']);
Route::get('/shop',[ClientController::class, 'shop']);
Route::get('/cart',[ClientController::class, 'cart']);
Route::get('/checkout',[ClientController::class, 'checkout']);
Route::get('/register',[ClientController::class, 'register']);
Route::get('/signin',[ClientController::class, 'signin']);
//Add TO cart
Route::get('/addtocart/{id}',[ClientController::class, 'addtocart']);
Route::put("/cart/updateqty/{id}", [ClientController::class,"updateqty"]);
Route::get("cart/removeitem/{id}",[ClientController::class, 'removeitem']);

// Creat Client Account
Route::post("/createaccount", [ClientController::class, "createaccount"]);
Route::post("/accessaccount", [ClientController::class, 'accessaccount']);
Route::get("/logout", [ClientController::class, "logout"]);
Route::post("/tobuy", [ClientController::class, "tobuy"]);
Route::get("/paymentSuccess", [ClientController::class, "paymentSuccess"]);
// Admin Controller
Route::get('/admin',[AdminController::class, "home"]);
Route::get('/admin/addcategory',[AdminController::class, "addcategory"]);
Route::get('/admin/categories',[AdminController::class, "categories"]);
Route::get('/admin/addslider',[AdminController::class, "addslider"]);
Route::get('/admin/slider',[AdminController::class, "slider"]);
Route::get('/admin/products',[AdminController::class, "products"]);
Route::get('/admin/addproduct',[AdminController::class, "addproduct"]);
Route::get('/admin/orders',[AdminController::class, "orders"]);


// Category controller

Route::post('/admin/savecategory',[CategoryController::class,"savecategory"]);
Route::delete('/admin/deleteCategory/{id}',[CategoryController::class,"deleteCategory"]);
Route::get('admin/editeCategory/{id}', [CategoryController::class, "editeCategory"]);
Route::put('admin/updatecategory/{id}',[CategoryController::class,"updatecategory"]);


// Slider Controller 
Route::post("/admin/saveslider",[SliderController::class,"saveslider"]);
Route::delete("/admin/deleteslider/{id}",[SliderController::class, "deleteslider"]);
Route::get("/admin/editeSlider/{id}",[SliderController::class, "editeSlider"]);
Route::put("/admin/updateSlider/{id}", [SliderController::class, "updateSlider"]);
Route::put("/admin/DesactivateSlider/{id}", [SliderController::class,"DesactivateSlider"]);
Route::put("/admin/activateSlider/{id}", [SliderController::class, "activateSlider"]);


// Product Controller

Route::post("/admin/saveproduct", [ProductController::class, "saveproduct"]);
Route::delete("/admin/deleteproduct/{id}",[ProductController::class, "deleteproduct"]);
Route::get("/admin/editeproduct/{id}", [ProductController::class, "editeproduct"]);
Route::put("/admin/updateproduct/{id}", [ProductController::class, "updateproduct"]);
Route::put("/admin/Desactivate/{id}", [ProductController::class,"Desactivate"]);
Route::put("/admin/Activate/{id}", [ProductController::class, "activate"]);

// PDF CONTRLLER

Route::get("ShowCommand/{id}", [PdfController::class, "ShowCommand"] );
