<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FixedPointController extends Controller
{
    public function fixedPoint(){
        $data = [];
        $data["title"] = __('fixed_point.title');
        return view('fixedPoint')->with("data",$data);
    }

    public function fixedPointMethod(Request $request){
        $data = [];
        $f_function = $request->input('f_function');
        $data['f_function'] = $f_function;
        $f_function = '"'.$f_function.'"';
        $g_function = $request->input('g_function');
        $data['g_function'] = $g_function;
        $g_function = '"'.$g_function.'"';
        $initial_x = $request->input('initial_x');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');
        $data['initial_x'] = $initial_x;
        $data['tolerance'] = $tolerance;
        $data['iterations'] = $iterations;
        $command = 'python "'.public_path().'\python\fixed_point.py" '."{$f_function} {$g_function} {$initial_x} {$tolerance} {$iterations}";
        //dd($command);
        exec($command, $output);
        
        $data["title"] = __('fixed_point.title');
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
        return view('fixedPoint')->with("data",$data);
    }
}