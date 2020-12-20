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

Route::get('/article', 'ArticlesController@getArticlesData')->name('getArticlesData');

Route::post('/addArticle', 'ArticlesController@addArticlesData')->name('addArticles');

Route::post('/updateArticle', 'ArticlesController@updateArticlesData')->name('updateArticles');

Route::post('/deleteArticle', 'ArticlesController@deleteArticlesData')->name('deleteArticles');

Route::get('/test1','ArticlesController@getArticlesAllData');

Route::get('/test2','ArticlesController@getArticlesCursorData');

Route::get('/test3','ArticlesController@getArticlesDataRam');
