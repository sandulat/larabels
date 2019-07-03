<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LabelsController@index')->name('index');
Route::put('/', 'LabelsController@update')->name('update');
Route::post('/reset', 'ResetController')->name('reset');
Route::post('/commit', 'CommitController')->name('commit');
