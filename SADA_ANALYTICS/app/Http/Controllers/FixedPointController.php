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
        exec($command, $output);
        $data["title"] = __('fixed_point.title');
        if (!(strpos($output[0], "Error") === false)){
            if ((strpos($output[0], "Error processing results:") === false)){
                $data['message'] = substr($output[0],7,strlen($output[0])-9);
            }else{
                $data["message"] = $output[0];
            }
        }else{
            $json = json_decode($output[0],true);
            $data["table"] = $json;
            $data['message'] = __('fixed_point.success');
        }
        return view('fixedPoint')->with("data",$data);
    }
}