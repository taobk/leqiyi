<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

    return view('welcome');

});

Route::group([

    'namespace'=>'Pc\Auth\AuthController',

],function(){

    //登陆
    Route::get('login','AuthController@getLogin');

    Route::post('login','AuthController@postLogin');

    //注册
    Route::get('register','AuthController@getRegister');

    Route::post('register','AuthController@postRegister');

    //忘记密码
    Route::get('forget','AuthController@getForget');

    Route::post('forget','AuthController@postForget');

});




