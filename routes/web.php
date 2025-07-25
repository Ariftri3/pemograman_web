<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ThemeController;



//kode baru diubah menjadi seperti ini
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories',[HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);


Route::group(['prefix'=>'customer'], function(){
 Route::controller(CustomerAuthController::class)->group(function(){
 //tampilkan halaman login
 Route::get('login','login')->name('customer.login');
 //aksi login
 Route::post('login','store_login')->name('customer.store_login');
 //tampilkan halaman register
 Route::get('register','register')->name('customer.register');
 //aksi register
 Route::post('register','store_register')->name('customer.store_register');
 //aksi logout
 Route::post('logout','logout')->name('customer.logout');
 });
});


Route::resource('themes', \App\Http\Controllers\ThemeController::class);
Route::resource('menus', \App\Http\Controllers\MenuController::class);


Route::group(['prefix'=>'dashboard'], function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories',ProductCategoryController::class);
    Route::resource('products',productController::class);
    route::resource('menus', MenuController::class);
    route::resource('themes', ThemeController::class);

})->middleware(['auth', 'verified']);


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


require __DIR__.'/auth.php';
