<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@home')->name("home");

Route::get('/raices','HomeController@calculoRaices')->name("raices");
Route::POST('/busquedasIncrementales','HomeController@busquedasIncrementales')->name("busquedasIncrementales");
