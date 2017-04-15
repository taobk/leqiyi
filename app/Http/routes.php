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

    'namespace'=>'Pc\Auth',

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

//获取图片验证码
Route::get('captcha', function () {
    return Captcha::create();
});

//检测图片验证码是正确
Route::get('captcha/check', function () {
    if (Captcha::check($_GET['captcha'])) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
});




