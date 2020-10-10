<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncrementalSearchController extends Controller
{
    public function incrementalSearch(){
        $data = [];
        $data["validar"] = "false";
        $data["title"] = __('incremental.title');
        return view('incrementalMethod')->with("data",$data);
    }

    public function incrementalSearchMethod(Request $request){
        $x_inicial = $request->input('x_inicial');
        $delta = $request->input('delta');
        $iteraciones = $request->input('iteraciones');
        $funcionOriginal = $request->input('funcion');
        $funcion = '"'.$funcionOriginal.'"';
        $comando = 'python "'.public_path().'\python\incremental_search.py" '."{$x_inicial} {$delta} {$iteraciones} {$funcion}";
        exec($comando, $output);
        $data = [];
        $data["title"] = __('incremental.title');
        $json = json_decode($output[0],true);
        $data["json"] = $json;
        $data["validar"] = "true";
        $data["x_inicial"] = $x_inicial;
        $data["delta"] = $delta;
        $data["iteraciones"] = $iteraciones;
        $data["funcion"] = $funcionOriginal;
        return view('incrementalMethod')->with("data",$data);
    }
}