<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncrementalSearchController extends Controller
{
    public function incrementalSearch(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["check"] = "false";
        $data["title"] = __('incremental.title');
        return view('incrementalMethod')->with("data",$data);
    }

    public function incrementalSearchMethod(Request $request){
        $x_0 = $request->input('x_0');
        $delta = $request->input('delta');
        $save = $request->input("save");
        $iterations = $request->input('iterations');
        $originalFunction = $request->input('function');
        $function = '"'.$originalFunction.'"';

        $mem = session()->get("mem");
        $indexMem = $mem[0][0];
        $mem[0][0] = $mem[0][0]+1;
        if ($mem[0][0] > 5){
            $mem[0][0] = 1;
        }
        $auxMem = [];
        if ($save == "save"){
            array_push($auxMem,$originalFunction);
            $mem[0][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }

        $command = 'python "'.public_path().'\python\incremental_search.py" '."{$x_0} {$delta} {$iterations} {$function}";
        //$command = 'python3 "'.public_path().'/python/incremental_search.py" '."{$x_0} {$delta} {$iterations} {$function}";
        exec($command, $output);
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["title"] = __('incremental.title');
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $json = json_decode($output[0],true);
            $data["json"] = $json;
            $data["check"] = "true";
            $data["x_0"] = $x_0;
            $data["delta"] = $delta;
            $data["iterations"] = $iterations;
            $data["function"] = $originalFunction;
        }
        return view('incrementalMethod')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = __('incremental.title');
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('incrementalMethod')->with("data",$data);
    }
}