<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecantController extends Controller
{
    public function secant(){
        $data = [];
        $data["title"] = __('secant.title');
        return view('secant')->with("data",$data);
    }

    public function secantMethod(Request $request){
        $command = 'python "'.public_path().'\python\secant.py" ';
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