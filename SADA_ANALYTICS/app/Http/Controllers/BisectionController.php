<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BisectionController extends Controller
{
    public function bisection(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["solution"] = "false";
        $data["title"] = __('bisection.title');
        return view('bisection')->with("data",$data);
    }

    public function bisectionMethod(Request $request){
        $data = [];
        $f_function = $request->input('f_function');
        $data['f_function'] = $f_function;
        $f_function = '"'.$f_function.'"';
        $a_value = $request->input('a_value');
        $b_value = $request->input('b_value');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');

        $save = $request->input("save");

        $data['a_value'] = $a_value;
        $data['b_value'] = $b_value;
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

        $command = 'python "'.public_path().'\python\bisection.py" '."{$f_function} {$a_value} {$b_value} {$tolerance} {$iterations}";
        //$command = 'python3 "'.public_path().'/python/bisection.py" '."{$f_function} {$a_value} {$b_value} {$tolerance} {$iterations}";
        exec($command, $output);

        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";

        $data["title"] = __('bisection.title');
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
            $data['message'] = __('bisection.success');
        }
        return view('bisection')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Bisection";
        $data["solution"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('bisection')->with("data",$data);
    }
}