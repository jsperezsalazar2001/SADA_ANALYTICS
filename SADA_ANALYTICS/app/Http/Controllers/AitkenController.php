<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AitkenController extends Controller
{
    public function aitken(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = __('aitken.title');
        $data["message"] = __('aitken.title');
        return view('aitkenMethod')->with("data",$data);
    }

    public function aitkenMethod(Request $request){
        $x_0 = $request->input('x_0');
        $x_1 = $request->input('x_1');
        $iterations = $request->input('iterations');
        $originalfunction = $request->input('function');
        $function = '"'.$originalfunction.'"';
        $tolerance = $request->input('tolerance');
        $comando = 'python "'.public_path().'\python\aitken.py" '."{$x_0} {$x_1} {$tolerance} {$function} {$iterations}";
        exec($comando, $output);
        $data = [];
        $data["title"] = __('aitken.title');
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $json = json_decode($output[0],true);
            $data["json"] = $json;
            $data["check"] = "true";
            $data["x_0"] = $x_0;
            $data["x_1"] = $x_1;
            $data["iterations"] = $iterations;
            $data["function"] = $originalfunction;
            $data["tolerance"] = $tolerance;
            $data["message"] = __('aitken.succesful');
        }
        return view('aitkenMethod')->with("data",$data);
    }
}