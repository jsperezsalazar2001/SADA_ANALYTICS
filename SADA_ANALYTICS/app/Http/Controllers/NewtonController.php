<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewtonController extends Controller
{
    public function newton(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["solution"] = "false";
        $data["title"] = __('newton.title');
        return view('newton')->with("data",$data);
    }

    public function newtonMethod(Request $request){
        $data = [];
        $f_function = $request->input('f_function');
        $data['f_function'] = $f_function;
        $f_function = '"'.$f_function.'"';
        $df_function = $request->input('df_function');
        $data['df_function'] = $df_function;
        $df_function = '"'.$df_function.'"';
        $initial_x = $request->input('initial_x');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');

        $save = $request->input("save");

        $data['initial_x'] = $initial_x;
        $data['tolerance'] = $tolerance;
        $data['iterations'] = $iterations;

        $mem = session()->get("mem");
        $indexMem = $mem[0][0];
        $mem[0][0] = $mem[0][0]+1;
        if ($mem[0][0] > 5){
            $mem[0][0] = 1;
        }
        $auxMem = [];
        if ($save == "save"){
            array_push($auxMem,$data['f_function']);
            $mem[0][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }

        //$command = 'python "'.public_path().'\python\newton.py" '."{$f_function} {$df_function} {$initial_x} {$tolerance} {$iterations}";
        $command = 'python3 "'.public_path().'/python/newton.py" '."{$f_function} {$df_function} {$initial_x} {$tolerance} {$iterations}";
        exec($command, $output);

        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";

        $data["title"] = __('newton.title');
        if (!(strpos($output[0], "Error") === false)){
            if ((strpos($output[0], "Error processing results:") === false)){
                $data['message'] = substr($output[0],7,strlen($output[0])-9);
            }else{
                $data["message"] = $output[0];
            }
            $data["solution"] = "false";
        }else{
            $json = json_decode($output[0],true);
            $data["table"] = $json;
            $data["solution"] = "true";
        }
        return view('newton')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Newton";
        $data["solution"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('newton')->with("data",$data);
    }
}