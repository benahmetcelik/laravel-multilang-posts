<?php
/*
Route::group([
    'prefix' => 'seo', 'as' => 'seo::',
    'namespace' => '\Seo\Http\Controllers'], function () {

    Route::get('/{theme_select?}', ['uses' => 'SiteMapController@index', 'as' => 'sitemap.index']);

});
*/

Route::group([
    'prefix' => 'multilangpost', 'as' => 'multilangpost::',
    'namespace' => '\MultiLangPost\Http\Controllers'], function () {

    Route::get('/{model?}', ['uses' => 'MultiLangPostController@index', 'as' => 'multilangpost.index']);

});