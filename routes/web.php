<?php

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

Auth::routes();

// Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

// Report
Route::resource('/report', 'ReportController');

// Sales
Route::resource('/sales', 'SalesController');

// Inventory
Route::get('/inventory', 'InventoryController@index')->name('inventory.index');

// Label
// Route::match(['put', 'patch'], '/product/update_label/{label}', 'ProductController@update_label')->name('label.update');
Route::delete('/product/destroy_label/{label}', 'ProductController@destroy_label')->name('label.destroy');
Route::post('/product/store_label', 'ProductController@store_label')->name('label.store');
Route::get('/product/data_label', 'ProductController@data_label')->name('label.data');

// Category
// Route::match(['put', 'patch'], '/product/update_category/{category}', 'ProductController@update_category')->name('category.update');
Route::delete('/product/destroy_category/{category}', 'ProductController@destroy_category')->name('category.destroy');
Route::post('/product/store_category', 'ProductController@store_category')->name('category.store');
Route::get('/product/data_category', 'ProductController@data_category')->name('category.data');

// Product
Route::get('/product/data_product', 'ProductController@data_product')->name('product.data');
Route::resource('/product', 'ProductController');

// Customer
Route::get('/customer/data', 'CustomerController@data')->name('customer.data');
Route::resource('/customer', 'CustomerController');

// Supplier
Route::get('/supplier/data', 'SupplierController@data')->name('supplier.data');
Route::resource('/supplier', 'SupplierController');

// Employee
Route::get('/employee/data', 'UserController@data')->name('employee.data');
Route::resource('/employee', 'UserController');

// Store
Route::get('/store/data', 'StoreController@data')->name('store.data');
Route::resource('/store', 'StoreController');

// Config
Route::resource('/config', 'ConfigController');