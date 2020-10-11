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
        if (!(strpos($output[0], "Error") === false)){
            if ((strpos($output[0], "Error processing results:") === false)){
                $data['message'] = substr($output[0],7,strlen($output[0])-9);
            }else{
                $data["message"] = $output[0];
            }
        }else{
            $json = json_decode($output[0],true);
            $data["table"] = $json;
            $data['message'] = __('steffensen.success');
        }
        return view('steffensen')->with("data",$data);
    }
}