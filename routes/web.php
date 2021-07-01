<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin_controller\DashboardController;
use App\Http\Controllers\admin_controller\ProductController;
use App\Http\Controllers\admin_controller\CustomUserController;
use App\Http\Controllers\frontend_controller\MainController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\viewCartController;
use App\Http\Controllers\checkOutController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\admin_controller\CommonUserController;

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
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('frontend_view/index');
// });
Route::get('/{id}/edit', 'App\Http\Controllers\frontend_controller\MainController@edit');
Route::get('/removeItem/{id}',[App\Http\Controllers\frontend_controller\MainController::class,'deleteItem']);
Route::post('partno', [App\Http\Controllers\frontend_controller\MainController::class, 'search_pro'])->name('partno');
Route::resource('/', MainController::class);
//Route::resource('main', 'App\Http\Controllers\frontend_controller\MainController');

Route::get('view_cart', [App\Http\Controllers\viewCartController::class, 'index'])->name('view_cart');
Route::post('update_cart', [App\Http\Controllers\viewCartController::class, 'updateCart'])->name('update_cart');
Route::get('check_out', [App\Http\Controllers\checkOutController::class, 'index'])->name('check_out');
Route::post('proceed', [App\Http\Controllers\checkOutController::class, 'final_checkout'])->name('proceed');
Route::get('csv_view', [App\Http\Controllers\ImportExportController::class, 'importExportView'])->name('csv_view');
Route::get('export', [App\Http\Controllers\ImportExportController::class, 'export'])->name('export');
Route::post('import', [App\Http\Controllers\ImportExportController::class, 'import'])->name('import');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('shopApp', 'App\Http\Controllers\admin_controller\ProductController');
    Route::resource('profile', 'App\Http\Controllers\admin_controller\CustomUserController');
    Route::resource('general', 'App\Http\Controllers\GeneralController');
    Route::get('/dashboard', [App\Http\Controllers\admin_controller\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/product', [App\Http\Controllers\admin_controller\ProductController::class, 'index'])->name('product');
    Route::get('/delete_product/{id}',[App\Http\Controllers\admin_controller\ProductController::class,'destroy']);
    Route::resource('common_users', CommonUserController::class);
    Route::get('/delete_user/{id}',[App\Http\Controllers\admin_controller\CommonUserController::class,'destroy']);
});

//Route::get('/addtocart/{id}',[App\Http\Controllers\frontend_controller\MainController::class,'addCart']);
