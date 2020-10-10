<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SteffensenController extends Controller
{
    public function steffensen(){
        $data = [];
        $data["title"] = __('steffensen.title');
        return view('steffensen')->with("data",$data);
    }

    public function steffensenMethod(Request $request){
        $command = 'python "'.public_path().'\python\steffensen.py" ';
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