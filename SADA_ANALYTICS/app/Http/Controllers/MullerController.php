<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MullerController extends Controller
{
    public function muller(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = __('muller.title');
        $data["message"] = "Si lo deseas puedes dejar el campo x_2 vacio, el sistema determinara x_2 como el punto medio de x_0 y x_1";
        return view('mullerMethod')->with("data",$data);
    }

    public function mullerMethod(Request $request){
        $x_0 = $request->input('x_0');
        $x_1 = $request->input('x_1');
        if ($request->input('x_2')){
            $x_2 = $request->input('x_2');
        }else{
            $x_2 = ($x_0+$x_1)/2;
        }
        $iterations = $request->input('iterations');
        $originalfunction = $request->input('function');
        $function = '"'.$originalfunction.'"';
        $tolerance = $request->input('tolerance');
        $comando = 'python "'.public_path().'\python\muller.py" '."{$x_0} {$x_1} {$x_2} {$tolerance} {$function} {$iterations}";
        exec($comando, $output);
        $data = [];
        if (substr($output[0],7,5) == "Error"){
            $data["title"] = __('muller.title');
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $json = json_decode($output[0],true);
            $data = [];
            $data["title"] = __('muller.title');
            $data["json"] = $json;
            $data["check"] = "true";
            $data["x_0"] = $x_0;
            $data["x_1"] = $x_1;
            $data["x_2"] = $x_2;
            $data["iterations"] = $iterations;
            $data["function"] = $originalfunction;
            $data["tolerance"] = $tolerance;
            $data["message"] = "Exito corriento el metodo";
        }
        return view('mullerMethod')->with("data",$data);
    }
}