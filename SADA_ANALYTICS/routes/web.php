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

Route::GET('/linealSpline','LinealSplineController@linealSpline')->name("linealSpline");
Route::POST('/linealSplineMethod','LinealSplineController@linealSplineMethod')->name("linealSpline_method");

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

Route::GET('/cholesky','CholeskyController@cholesky')->name("cholesky");
Route::POST('/choleskyMethod','CholeskyController@choleskyMethod')->name("cholesky_method");

Route::GET('/croutTridiagonal','CroutTridiagonalController@croutTridiagonal')->name("crout_tridiagonal");
Route::POST('/croutTridiagonalMethod','CroutTridiagonalController@croutTridiagonalMethod')->name("crout_tridiagonal_method");

Route::GET('/cuadraticSpline','CuadraticSplineController@cuadraticSpline')->name("cuadraticSpline");
Route::POST('/cuadraticSpline','CuadraticSplineController@cuadraticSplineMethod')->name("cuadratic_spline_method");

Route::GET('/cubicSpline','CubicSplineController@cubicSpline')->name("cubicSpline");
Route::POST('/cubicSpline','CubicSplineController@cubicSplineMethod')->name("cubic_spline_method");

Route::GET('/neville','NevilleController@neville')->name("neville");
Route::POST('/nevilleMethod','NevilleController@nevilleMethod')->name("neville_method");

Route::get('/storageDoolittle/{storage}/{method}', 'DoolittleController@storage')->name("storage_doolittle");
Route::get('/storageLagrange/{storage}/{method}', 'LagrangeController@storage')->name("storage_lagrange");
Route::get('/storageLinealSpline/{storage}/{method}', 'LinealSplineController@storage')->name("storage_linealSpline");
Route::get('/storageStepped/{storage}/{method}', 'SteppedController@storage')->name("storage_stepped");
Route::get('/storageHermite/{storage}/{method}', 'HermiteController@storage')->name("storage_hermite");
Route::get('/storageAitken/{storage}/{method}', 'AitkenController@storage')->name("storage_aitken");
Route::get('/storageMuller/{storage}/{method}', 'MullerController@storage')->name("storage_muller");
Route::get('/storageIncremental/{storage}/{method}', 'IncrementalSearchController@storage')->name("storage_incremental");

Route::GET('/dividedDifference','DividedDifferenceMethodController@dividedDifference')->name("divided_difference");
Route::POST('/dividedDifferenceMethod','DividedDifferenceMethodController@dividedDifferenceMethod')->name("divided_difference_method");

Route::GET('/gaussianTridiagonalMatrix','GaussianTridiagonalMatrixMethodController@gaussianTridiagonalMatrix')->name("gaussian_tridiagonal_matrix");
Route::POST('/gaussianTridiagonalMatrixMethod','GaussianTridiagonalMatrixMethodController@gaussianTridiagonalMatrixMethod')->name("gaussian_tridiagonal_matrix_method");

Route::GET('/functionPlotter','FunctionPlotterController@grapher')->name("function_plotter");

Route::GET('/about','AboutController@about')->name("about_us");
