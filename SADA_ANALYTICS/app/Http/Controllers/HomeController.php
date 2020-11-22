<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        $mem = session()->get("mem");
        if ($mem == null){
            $aitken = [1];
            $bisection = [1];
            $cholesky = [1];
            $crout = [1];
            $croute_tridiagonal = [1];
            $cuadratic_spline = [1];
            $cubic_spline = [1];
            $divided_difference = [1];
            $doolittle = [1];
            $false_position = [1];
            $fixed_point = [1];
            $gauss_seidel = [1];
            $gauss_tridiagonal_matrix = [1];
            $hermite = [1];
            $incremental_search = [1];
            $iterative_method_S = [1];
            $iterative_methosD_GB = [1];
            $jacobi = [1];
            $lagrange = [1];
            $lineal_spline = [1];
            $lu_simple = [1];
            $muller = [1];
            $multiple_roots = [1];
            $newton = [1];
            $partial_gaussian = [1];
            $partial_lu = [1];
            $secant = [1];
            $simple_gaussian = [1];
            $sor = [1];
            $steffensen = [1];
            $stepped = [1];
            $total_gaussian = [1];
            $vandermonde = [1];
            //$mem[0] = 1;
            $mem[0] = $aitken;
            $mem[1] = $bisection;
            $mem[2] = $cholesky;
            $mem[3] = $crout;
            $mem[4] = $croute_tridiagonal;
            $mem[5] = $cuadratic_spline;
            $mem[6] = $cubic_spline;
            $mem[7] = $divided_difference;
            $mem[8] = $doolittle;
            $mem[9] = $false_position;
            $mem[10] = $fixed_point;
            $mem[11] = $gauss_seidel;
            $mem[12] = $gauss_tridiagonal_matrix;
            $mem[13] = $hermite;
            $mem[14] = $incremental_search;
            $mem[15] = $iterative_method_S;
            $mem[16] = $iterative_methosD_GB;
            $mem[17] = $jacobi;
            $mem[18] = $lagrange;
            $mem[19] = $lineal_spline;
            $mem[20] = $lu_simple;
            $mem[21] = $muller;
            $mem[22] = $multiple_roots;
            $mem[23] = $newton;
            $mem[24] = $partial_gaussian;
            $mem[25] = $partial_lu;
            $mem[26] = $secant;
            $mem[27] = $simple_gaussian;
            $mem[28] = $sor;
            $mem[29] = $steffensen;
            $mem[30] = $stepped;
            $mem[31] = $total_gaussian;
            $mem[32] = $vandermonde;
        }
        session()->put("mem",$mem);
        return view('homePage');
    }
}