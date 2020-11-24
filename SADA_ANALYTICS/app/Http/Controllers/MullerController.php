<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MullerController extends Controller
{
    public function muller(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["check"] = "false";
        $data["title"] = __('muller.title');
        return view('mullerMethod')->with("data",$data);
    }

    public function mullerMethod(Request $request){
        $x_0 = $request->input('x_0');
        $x_1 = $request->input('x_1');
        $save = $request->input("save");
        if ($request->input('x_2')){
            $x_2 = $request->input('x_2');
        }else{
            $x_2 = ($x_0+$x_1)/2;
        }
        $iterations = $request->input('iterations');
        $originalfunction = $request->input('function');
        $function = '"'.$originalfunction.'"';
        $tolerance = $request->input('tolerance');

        $mem = session()->get("mem");
        $indexMem = $mem[0][0];
        $mem[0][0] = $mem[0][0]+1;
        if ($mem[0][0] > 5){
            $mem[0][0] = 1;
        }
        $auxMem = [];
        if ($save == "save"){
            array_push($auxMem,$originalfunction);
            $mem[0][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }

        //$comando = 'python "'.public_path().'\python\muller.py" '."{$x_0} {$x_1} {$x_2} {$tolerance} {$function} {$iterations}";
        $comando = 'python3 "'.public_path().'/python/muller.py" '."{$x_0} {$x_1} {$x_2} {$tolerance} {$function} {$iterations}";
        exec($comando, $output);
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["title"] = __('muller.title');
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $json = json_decode($output[0],true);
            $data["json"] = $json;
            $data["check"] = "true";
            $data["x_0"] = $x_0;
            $data["x_1"] = $x_1;
            $data["x_2"] = $x_2;
            $data["iterations"] = $iterations;
            $data["function"] = $originalfunction;
            $data["tolerance"] = $tolerance;
        }
        return view('mullerMethod')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Muller";
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('mullerMethod')->with("data",$data);
    }
}