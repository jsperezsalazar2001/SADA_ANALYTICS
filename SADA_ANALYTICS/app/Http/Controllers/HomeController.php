<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('homePage');
    }

    public function calculoRaices(){
        return view('calculoRaices');
    }

    public function busquedasIncrementales(Request $request){
        $x_inicial = $request->input('x_inicial');
        $delta = $request->input('delta');
        $iteraciones = $request->input('iteraciones');
        $funcion = $request->input('funcion');
        $funcion = '"'.$funcion.'"';
        $comando = 'python "'.public_path().'\python\busquedaIncremental.py" '."{$x_inicial} {$delta} {$iteraciones} {$funcion}";
        exec($comando, $output);
        dd($output);
        #echo "x: ".$x_inicial." delta: ".$delta." iteraciones: ".$iteraciones." funcion: ".$funcion;
        // Llamado de la funcion de python
    }
}