<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
 Route::get('/',array('as' => 'home', 'uses'=>'HomeController@index'));
 Route::get('/detail/{id}',array('as' => 'detail', 'uses'=>'HomeController@detail')) ->where('id', '[0-9]+');
 Route::get('category/{id}',array('as' => 'category', 'uses'=>'HomeController@category')) ->where('id', '[0-9]+');
 Route::post('/addToCart/',array('as' => 'addToCart', 'uses'=>'HomeController@addToCart'));
 Route::post('/removeItem/',array('as' => 'removeItem', 'uses'=>'HomeController@removeItem'));
Route::any('/payment/',array('as' => 'payment', 'uses'=>'HomeController@payment'));
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'HomeController@paymentStatus',
));
Route::group(array('prefix' => 'admin'), function () {
    Route::get('/',array('before'=>'admin-login','as' => 'login-form', 'uses'=>'DefaultController@showLogin'));
    Route::post('authenticate',array('as' => 'authenticate', 'uses'=>'DefaultController@authenticateUser'));
    Route::get('dashboard',array('before'=>'admin-not-login','as' => 'dashboard', 'uses'=>'DefaultController@dashboard'));
    Route::get('logout',array('before'=>'admin-not-login','as' => 'admin_logout', 'uses'=>'DefaultController@logout'));
    
     /****************Categories  routing****************************/
    Route::get('categories',array('before'=>'admin-not-login','as' => 'categories', 'uses'=>'CategoriesController@index'));
    Route::get('categories/delete/{id}',array('before'=>'admin-not-login','as' => 'category_delete', 'uses'=>'CategoriesController@delete'))
    ->where('id', '[0-9]+');
    Route::any('categories/add',array('as' => 'add_category', 'uses'=>'CategoriesController@add'));
    Route::any('categories/update/{id}',array('as' => 'update_category', 'uses'=>'CategoriesController@update'))
    ->where('id', '[0-9]+');

    /**********************************************************/
     /****************products  routing****************************/
    Route::get('products',array('before'=>'admin-not-login','as' => 'products', 'uses'=>'ProductsController@index'));
    Route::get('products/delete/{id}',array('before'=>'admin-not-login','as' => 'product_delete', 'uses'=>'ProductsController@delete'))
    ->where('id', '[0-9]+');
    Route::any('products/add',array('before'=>'admin-not-login','as' => 'add_product', 'uses'=>'ProductsController@add'));
    Route::any('products/update/{id}',array('before'=>'admin-not-login','as' => 'update_product', 'uses'=>'ProductsController@update'))
    ->where('id', '[0-9]+');

    /**********************************************************/



});

