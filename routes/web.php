<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Superadmin')->prefix('superadmin')->middleware('auth', 'can:isSuperadmin')->name('superadmin.')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/auto-detail/home', 'AutoDetailController@index')->name('auto-detail.home');

    Route::prefix('auto-detail-form')->name('form.')->group(function(){
        Route::get('/home', 'FormController@index')->name('home');
        Route::get('/start', 'FormController@start')->name('start');
        Route::get('/finish/{autoDetail}', 'FormController@finish')->name('finish');

        Route::get('/vehicle-received/{autoDetail}', 'FormController@vehicleReceived')->name('vehicle.received');
        Route::put('/vehicle-received/store/{autoDetail}', 'FormController@vehicleReceivedStore')->name('vehicle.received.store');

        // Route::get('/invoice-dp', 'FormController@invoiceDp')->name('invoice.dp');
        Route::get('/invoice-dp/{autoDetail}', 'FormController@invoiceDp')->name('invoice.dp');
        Route::put('/invoice-dp/store/{autoDetail}', 'FormController@invoiceDpStore')->name('invoice.dp.store');

        // Route::get('/vehicle-inspection', 'FormController@vehicleInspection')->name('vehicle.inspection');
        Route::get('/vehicle-inspection/{autoDetail}', 'FormController@vehicleInspection')->name('vehicle.inspection');
        Route::put('/vehicle-inspection/store/{autoDetail}', 'FormController@vehicleInspectionStore')->name('vehicle.inspection.store');

        // Route::get('/warrant', 'FormController@warrant')->name('warrant');
        Route::get('/warrant/{autoDetail}', 'FormController@warrant')->name('warrant');
        Route::put('/warrant/store/{autoDetail}', 'FormController@warrantStore')->name('warrant.store');

        // Route::get('/invoice-payment', 'FormController@invoicePayment')->name('invoice.payment');
        Route::get('/invoice-payment/{autoDetail}', 'FormController@invoicePayment')->name('invoice.payment');
        Route::put('/invoice-payment/store/{autoDetail}', 'FormController@invoicePaymentStore')->name('invoice.payment.store');

        Route::get('/vehicle-delivery/{autoDetail}', 'FormController@vehicleDelivery')->name('vehicle.delivery');
        Route::put('/vehicle-delivery/store/{autoDetail}', 'FormController@vehicleDeliveryStore')->name('vehicle.delivery.store');
    });


    Route::prefix('product')->name('product.')->group(function(){
        Route::get('/home', 'ProductController@index')->name('index');
        Route::get('/data', 'ProductController@data')->name('data');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/create', 'ProductController@store')->name('store');
        Route::get('/edit/{product}', 'ProductController@edit')->name('edit');
        Route::put('/edit/{product}', 'ProductController@update')->name('update');
        Route::delete('/delete/{product}', 'ProductController@destroy')->name('destroy');

    });

    Route::prefix('list')->name('list.')->group(function(){
        Route::get('/vehicle-received', 'AutoDetailController@vehicleReceived')->name('vehicle.received');
        Route::get('/invoice-dp', 'AutoDetailController@invoiceDp')->name('invoice.dp');
        Route::get('/vehicle-inspection', 'AutoDetailController@vehicleInspection')->name('vehicle.inspection');
        Route::get('/warrant', 'AutoDetailController@warrant')->name('warrant');
        Route::get('/invoice-payment', 'AutoDetailController@invoicePayment')->name('invoice.payment');
        Route::get('/vehicle-delivery', 'AutoDetailController@vehicleDelivery')->name('vehicle.delivery');
    });

    Route::prefix('crew')->name('crew.')->group(function(){
        Route::get('/home', 'CrewController@index')->name('index');
        // Route::get('/data', 'CrewController@data')->name('data');
        Route::get('/show/{crew}', 'CrewController@show')->name('show');
        Route::get('/create', 'CrewController@create')->name('create');
        Route::post('/create', 'CrewController@store')->name('store');
        Route::get('/edit/{crew}', 'CrewController@edit')->name('edit');
        Route::put('/edit/{crew}', 'CrewController@update')->name('update');
        Route::delete('/delete/{crew}', 'CrewController@destroy')->name('destroy');

    });

    Route::prefix('customer')->name('customer.')->group(function(){
        Route::get('/home', 'CustomerController@index')->name('index');
        // Route::get('/data', 'CustomerController@data')->name('data');
        Route::get('/show/{customer}', 'CustomerController@show')->name('show');
        Route::get('/create', 'CustomerController@create')->name('create');
        Route::post('/create', 'CustomerController@store')->name('store');
        Route::get('/edit/{customer}', 'CustomerController@edit')->name('edit');
        Route::put('/edit/{customer}', 'CustomerController@update')->name('update');
        Route::delete('/delete/{customer}', 'CustomerController@destroy')->name('destroy');

    });
});

Route::namespace('Admin')->prefix('admin')->middleware('auth', 'can:isAdmin')->name('admin.')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

