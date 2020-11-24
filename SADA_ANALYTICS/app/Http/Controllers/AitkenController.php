<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AitkenController extends Controller
{
    public function aitken(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["check"] = "false";
        $data["title"] = __('aitken.title');
        return view('aitkenMethod')->with("data",$data);
    }

    public function aitkenMethod(Request $request){
        $x_0 = $request->input('x_0');
        $x_1 = $request->input('x_1');
        $save = $request->input("save");
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
        //dd($function);
        $comando = 'python "'.public_path().'\python\aitken.py" '."{$x_0} {$x_1} {$tolerance} {$function} {$iterations}";
        exec($comando, $output);
        //dd($output);
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
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


    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Aitken";
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('aitkenMethod')->with("data",$data);
    }
}