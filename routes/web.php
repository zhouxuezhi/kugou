<?php

//初始化路由
// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| 先配置虚拟主机，配置完虚拟主机，输入域名直接访问后台首页
|--------------------------------------------------------------------------
*/
//后台 路由
Route::get('/','admin\IndexController@index');
Route::get('/gyx','admin\IndexController@gyx');
//周学智测试
Route::post('/','admin\IndexController@index'); 

