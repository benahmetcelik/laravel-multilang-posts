<?php
/*
Route::group([
    'prefix' => 'seo', 'as' => 'seo::',
    'namespace' => '\Seo\Http\Controllers'], function () {

    Route::get('/{theme_select?}', ['uses' => 'SiteMapController@index', 'as' => 'sitemap.index']);

});
*/

Route::group([
    'prefix' => 'ml', 'as' => 'multilangpost::',
    'namespace' => '\MultiLangPost\Http\Controllers'], function () {

    Route::get('/{model?}', ['uses' => 'MultiLangPostController@index', 'as' => 'index']);
    Route::get('/{lang}/{slug}', ['uses' => 'MultiLangPostController@content', 'as' => 'content']);
    Route::get('/{route?}/{view?}/{slug}', ['uses' => 'MultiLangPostController@query', 'as' => 'query']);


});