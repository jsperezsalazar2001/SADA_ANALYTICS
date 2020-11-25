<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SteffensenController extends Controller
{
    public function steffensen(){
        $data = [];

        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["solution"] = "false";

        $data["title"] = __('steffensen.title');
        return view('steffensen')->with("data",$data);
    }

    public function steffensenMethod(Request $request){
        $f_function = $request->input('f_function');
        $data['f_function'] = $f_function;
        $f_function = '"'.$f_function.'"';
        $initial_x = $request->input('initial_x');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');
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
        $save = $request->input("save");
        if ($save == "save"){
            array_push($auxMem,$data['f_function']);
            $mem[0][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }

        //$command = 'python "'.public_path().'\python\steffensen.py" '."{$f_function} {$initial_x} {$tolerance} {$iterations}";
        $command = 'python3 "'.public_path().'/python/steffensen.py" '."{$f_function} {$initial_x} {$tolerance} {$iterations}";
        exec($command, $output);
        
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        
        $data["title"] = __('steffensen.title');
        $error = json_decode($output[0],true);
        //dd($error["error"]);
        if (array_key_exists('aprox', $error)) {
            $data["aprox"] = $error["aprox"];
        }else{
            $data["aprox"] = false;
        }
        if ($error["error"] == "true"){
            $data["message"] = "Error while processing the results";
        }else{
            if ($error["error"] == False){
                $json = json_decode($output[1],true);
                $data["table"] = $json;
            }else{
                $data["message"] = $error["error"];
                if(count($output)>1){
                    $json = json_decode($output[1],true);
                    $data["table"] = $json;
                }
            }
        }
        return view('steffensen')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = __('steffensen.title');
        $data["solution"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('steffensen')->with("data",$data);
    }

}