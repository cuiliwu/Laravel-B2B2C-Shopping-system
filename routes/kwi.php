<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/17-11:23
 */

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([],function () {
    Route::get('login',['as' => 'admin.login','uses' => 'AuthController@login']);//登录
    Route::post('login',['as' => 'admin.dologin','uses' => 'AuthController@dologin']);//执行登录
    Route::get('logout',['as' => 'admin.logout','uses' => 'AuthController@logout']);//退出登录

    Route::get('404',['as' => 'admin.error.404','uses' => 'ErrorController@error404Action']);//404
    Route::get('500',['as' => 'admin.error.500','uses' => 'ErrorController@error500Action']);//500

});


Route::group(['middleware' =>  ['adminAuthenticate']], function () {
    Route::get('/','AdminIndexController@index','admin.index');

    // 用户管理
    Route::group(['namespace' =>  'User'], function () {
        // 后台用户管理
        Route::resource('user','UserController');
        // 角色
        Route::resource('role','RoleController');
        // 权限
        Route::resource('permission','PermissionController');
        // 菜单
        Route::resource('menu','MenuController');
    });

    Route::group(['namespace' =>  'Product','prefix'=>'product'], function () {
        Route::resource('cate','CategoryController');
        Route::resource('spec','SpecController');
        Route::resource('attribute','AttributeController');
        Route::resource('product','ProductController');
    });
});
