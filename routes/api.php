<?php
use Illuminate\Support\Facades\Route;

/**
 * Api routes here.
 */

Route::resource('record', 'RecordsController', [
    'except' => [
        'create',
        'edit',
    ],
]);
Route::get('record/search/{query}', [
    'uses' => 'RecordsController@search',
    'as' => 'record.search'
])->where('query', '[a-z0-9]');