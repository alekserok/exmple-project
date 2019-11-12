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

Route::get('/', 'HomeController@index');
Route::get('locale/{locale}', 'LanguageController@switchLang');
Route::get('careers', 'CareerController@index');
Route::post('careers/{type}', 'CareerController@store');
Route::get('faq', 'FaqController@index');
Route::get('philosophy', function () { return view('philosophy'); });
Route::get('performers', 'PerformerController@index');
Route::get('performers/{id}', 'PerformerController@show');
Route::get('performers/{id}/services', 'PerformerController@services');
Route::get('performers/{id}/avatar', 'PerformerController@avatar');
Route::get('orders', 'OrderController@create');
Route::post('orders', 'OrderController@store');
Route::get('orders/confirm', 'OrderController@confirmForm');
Route::post('orders/confirm', 'OrderController@confirm');
Route::get('orders/confirmed', function () { return view('orders.confirmed'); });
Route::get('categories', 'CategoryController@index');

Route::get('coming', function () { return view('coming'); });
Route::get('sitemap', function () { return view('sitemap'); });
Route::get('privacy', function () { return view('page'); });
Route::get('legal', function () {return view('page'); });

Route::get('transactions/{order_id}', 'TransactionController@show');
Route::post('transactions/purchase', 'TransactionController@purchase')->name('purchase');
Route::get('transactions/{id}/cancelled', 'TransactionController@cancelled')->name('purchase.cancelled');
Route::get('transactions/{id}/completed', 'TransactionController@completed')->name('purchase.completed');
Route::get('transactions/{order_id}/stripe/confirm/{payment_intent_id}', 'TransactionController@stripeConfirm');

Route::get('messages/history/{id}', 'MessageController@history');
Route::post('messages', 'MessageController@store');
Route::get('messages', 'MessageController@create');

Route::get('storage/thumbs/{width}_{height}_{name}', 'ThumbnailController@index');


//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('users', 'UsersController');
    Route::resource('pages', 'PagesController');
    Route::resource('activitylogs', 'ActivityLogsController')->only(['index', 'show', 'destroy']);
    Route::resource('settings', 'SettingsController');
    Route::resource('performers', 'PerformersController');
    Route::resource('services', 'ServicesController');
    Route::get('services/{id}/list', 'ServicesController@list');
    Route::resource('categories', 'CategoriesController');
    Route::delete('images/{id}', 'ImagesController@destroy');
    Route::resource('faq-categories', 'FaqCategoriesController');
    Route::resource('faq-categories', 'FaqCategoriesController');
    Route::resource('faqs', 'FaqsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('transactions', 'TransactionsController');
    Route::resource('careers', 'CareersController');
    Route::get('messages', function () { return view('admin.messages.index'); });
    Route::get('messages/{id}', 'MessagesController@history');
    Route::post('messages', 'MessagesController@store');
    Route::resource('colors', 'ColorsController');
    Route::resource('promos', 'PromosController');

    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});
