<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@home')->name("home");

Route::GET('/fixedPoint','FixedPointController@fixedPoint')->name("fixed_point");
Route::POST('/fixedPointMethod','FixedPointController@fixedPointMethod')->name("fixed_point_method");

Route::GET('/secant','SecantController@secant')->name("secant");
Route::POST('/secantMethod','SecantController@secantMethod')->name("secant_method");

Route::GET('/steffensen','SteffensenController@steffensen')->name("steffensen");
Route::POST('/steffensenMethod','SteffensenController@steffensenMethod')->name("steffensen_method");

Route::GET('/incremental','IncrementalSearchController@incrementalSearch')->name("incremental_search");
Route::POST('/incrementalMethod','IncrementalSearchController@incrementalSearchMethod')->name("incremental_search_method");

Route::GET('/muller','MullerController@muller')->name("muller");
Route::POST('/mullerMethod','MullerController@mullerMethod')->name("muller_method");

Route::GET('/gaussianMatrix','GaussianController@gaussian')->name("gaussian");
Route::POST('/gaussianMatrixCheck','GaussianController@values')->name("check_matrix");

Route::GET('/aitken','AitkenController@aitken')->name("aitken");
Route::POST('/aitkenMethod','AitkenController@aitkenMethod')->name("aitken_method");

Route::GET('/bisection','BisectionController@bisection')->name("bisection");
Route::POST('/bisectionMethod','BisectionController@bisectionMethod')->name("bisection_method");

Route::GET('/falsePosition','FalsePositionController@falsePosition')->name("false_position");
Route::POST('/falsePositionMethod','FalsePositionController@falsePositionMethod')->name("false_position_method");