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
        $data = [];
        $data["validar"] = "false";
        return view('calculoRaices')->with("data",$data);
    }

    public function busquedasIncrementales(Request $request){
        $x_inicial = $request->input('x_inicial');
        $delta = $request->input('delta');
        $iteraciones = $request->input('iteraciones');
        $funcionOriginal = $request->input('funcion');
        $funcion = '"'.$funcionOriginal.'"';
        $comando = 'python "'.public_path().'\python\busquedaIncremental.py" '."{$x_inicial} {$delta} {$iteraciones} {$funcion}";
        exec($comando, $output);
        $data = [];
        $json = json_decode($output[0],true);
        $data["json"] = $json;
        $data["validar"] = "true";
        $data["x_inicial"] = $x_inicial;
        $data["delta"] = $delta;
        $data["iteraciones"] = $iteraciones;
        $data["funcion"] = $funcionOriginal;
        return view('calculoRaices')->with("data",$data);
    }
}