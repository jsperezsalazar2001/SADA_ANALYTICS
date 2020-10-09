<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FixedPointController extends Controller
{
    public function fixedPoint(){
        $data = [];
        $data["title"] = __('fixed_point.title');
        return view('fixedPoint')->with("data",$data);
    }

    public function fixedPointMethod(Request $request){
        $command = 'python "'.public_path().'\python\fixed_point.py" ';
        exec($command, $output);
        dd($output);
        // $x_inicial = $request->input('x_inicial');
        // $delta = $request->input('delta');
        // $iteraciones = $request->input('iteraciones');
        // $funcion = $request->input('funcion');
        // $funcion = '"'.$funcion.'"';
        // $comando = 'python "'.public_path().'\python\busquedaIncremental.py" '."{$x_inicial} {$delta} {$iteraciones} {$funcion}";
        // exec($comando, $output);
        // dd($output);
        #echo "x: ".$x_inicial." delta: ".$delta." iteraciones: ".$iteraciones." funcion: ".$funcion;
        // Llamado de la funcion de python
    }
}