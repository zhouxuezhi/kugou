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
//专辑
Route::resource('/Album',"Admin\AlbumController");
//电台
Route::resource('/dianTai',"Admin\dianTaiController");
// Route::get('/Album',"Admin\AlbumController@store")->middleware('zhuanji');

