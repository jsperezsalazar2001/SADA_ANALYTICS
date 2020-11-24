<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SteffensenController extends Controller
{
    public function steffensen(){
        $data = [];
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
        $command = 'python "'.public_path().'\python\steffensen.py" '."{$f_function} {$initial_x} {$tolerance} {$iterations}";
        exec($command, $output);
        $data["title"] = __('steffensen.title');
        $error = json_decode($output[0],true);
        //dd($error["error"]);
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
}