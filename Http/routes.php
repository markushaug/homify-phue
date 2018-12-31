<?php

Route::group(['middleware' => 'web', 'prefix' => 'phue', 'namespace' => 'Modules\Phue\Http\Controllers'], function()
{
    Route::get('/', 'PhueController@index');
});
