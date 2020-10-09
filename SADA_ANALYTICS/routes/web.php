<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@home')->name("home");

Route::get('/raices','HomeController@calculoRaices')->name("raices");
Route::POST('/busquedasIncrementales','HomeController@busquedasIncrementales')->name("busquedasIncrementales");
Route::GET('/fixedPoint','FixedPointController@fixedPoint')->name("fixedPoint");
Route::POST('/fixedPointMethod','FixedPointController@fixedPointMethod')->name("fixed_point_method");
