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

// DASHBOARD
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

// REPORT
Route::resource('/report', 'ReportController');

// SALES
Route::resource('/sales', 'SalesController');

// INVENTORY
// Purchase Order
Route::get('/inventory/purchase_order', 'InventoryController@purchase_order')->name('inventory.purchase_order');
// Stock Opname
Route::get('/inventory/stock_opname', 'InventoryController@stock_opname')->name('inventory.stock_opname');
// Stock Out
Route::get('/inventory/stock_out', 'InventoryController@stock_out')->name('inventory.stock_out');
Route::post('/inventory/stock_out/', 'InventoryController@stock_out_store')->name('inventory.stock_out.store');
Route::get('/inventory/stock_out/create', 'InventoryController@stock_out_create')->name('inventory.stock_out.create');
Route::get('/inventory/stock_out/{id}', 'InventoryController@stock_out_show')->name('inventory.stock_out.show');
Route::get('/inventory/stock_out_data', 'InventoryController@stock_out_data')->name('inventory.stock_out.data');
// Stock In
Route::get('/inventory/stock_in', 'InventoryController@stock_in')->name('inventory.stock_in');
Route::post('/inventory/stock_in/', 'InventoryController@stock_in_store')->name('inventory.stock_in.store');
Route::get('/inventory/stock_in/create', 'InventoryController@stock_in_create')->name('inventory.stock_in.create');
Route::get('/inventory/stock_in/{id}', 'InventoryController@stock_in_show')->name('inventory.stock_in.show');
Route::get('/inventory/stock_in_data', 'InventoryController@stock_in_data')->name('inventory.stock_in.data');
// Stock Init
Route::get('/inventory', 'InventoryController@index')->name('inventory.index');
Route::get('/inventory/stock_data', 'InventoryController@stock_data')->name('inventory.stock.data');

// LABEL
// Route::match(['put', 'patch'], '/product/update_label/{label}', 'ProductController@update_label')->name('label.update');
Route::delete('/product/destroy_label/{label}', 'ProductController@destroy_label')->name('label.destroy');
Route::post('/product/store_label', 'ProductController@store_label')->name('label.store');
Route::get('/product/data_label', 'ProductController@data_label')->name('label.data');

// CATEGORY
// Route::match(['put', 'patch'], '/product/update_category/{category}', 'ProductController@update_category')->name('category.update');
Route::delete('/product/destroy_category/{category}', 'ProductController@destroy_category')->name('category.destroy');
Route::post('/product/store_category', 'ProductController@store_category')->name('category.store');
Route::get('/product/data_category', 'ProductController@data_category')->name('category.data');

// PRODUCT
Route::get('/product/data_product', 'ProductController@data_product')->name('product.data');
Route::resource('/product', 'ProductController');

// CUSTOMER
Route::get('/customer/data', 'CustomerController@data')->name('customer.data');
Route::resource('/customer', 'CustomerController');

// SUPPLIER
Route::get('/supplier/data', 'SupplierController@data')->name('supplier.data');
Route::resource('/supplier', 'SupplierController');

// EMPLOYEE
Route::get('/employee/data', 'EmployeeController@data')->name('employee.data');
Route::resource('/employee', 'EmployeeController');

// Config
// Route::resource('/config', 'ConfigController');