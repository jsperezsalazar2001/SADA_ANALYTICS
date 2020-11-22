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

Route::GET('/newton','NewtonController@newton')->name("newton");
Route::POST('/newtonMethod','NewtonController@newtonMethod')->name("newton_method");

Route::GET('/multipleRoots','MultipleRootsController@multipleRoots')->name("multiple_roots");
Route::POST('/multipleRootsMethod','MultipleRootsController@multipleRootsMethod')->name("multiple_roots_method");

Route::GET('/lagrange','LagrangeController@lagrange')->name("lagrange");
Route::POST('/lagrangeMethod','LagrangeController@lagrangeMethod')->name("lagrange_method");

Route::GET('/factorizationLUCreate','FactorizationLUController@factorizationLU')->name("factorization_l_u");
Route::POST('/factorizationLUShow','FactorizationLUController@values')->name("factorization_l_u_values");

Route::GET('/vandermonde','VandermondeController@vandermonde')->name("vandermonde");
Route::POST('/vandermondeMethod','VandermondeController@vandermondeMethod')->name("vandermonde_method");

Route::GET('/lagrange','LagrangeController@lagrange')->name("lagrange");
Route::POST('/lagrangeMethod','LagrangeController@lagrangeMethod')->name("lagrange_method");

Route::GET('/doolittle','DoolittleController@doolittle')->name("doolittle");
Route::POST('/doolittleMethod','DoolittleController@doolittleMethod')->name("doolitle_method");

Route::GET('/crout','CroutController@crout')->name("crout");
Route::POST('/croutMethod','CroutController@croutMethod')->name("crout_method");

Route::GET('/stepped','SteppedController@stepped')->name("stepped");
Route::POST('/steppedMethod','SteppedController@steppedMethod')->name("stepped_method");

Route::GET('/hermite','HermiteController@hermite')->name("hermite");
Route::POST('/hermiteMethod','HermiteController@hermiteMethod')->name("hermite_method");

Route::GET('/iterative','IterativeMethodJGBController@iterativeMethodJGB')->name("iterative_method");
Route::POST('/iterativeMethod','IterativeMethodJGBController@values')->name("iterative_j_g_b_values");