<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BisectionController extends Controller
{
    public function bisection(){
        $data = [];
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
        $data['a_value'] = $a_value;
        $data['b_value'] = $b_value;
        $data['tolerance'] = $tolerance;
        $data['iterations'] = $iterations;
        $command = 'python "'.public_path().'\python\bisection.py" '."{$f_function} {$a_value} {$b_value} {$tolerance} {$iterations}";
        exec($command, $output);
        $data["title"] = __('bisection.title');
        if (!(strpos($output[0], "Error") === false)){
            if ((strpos($output[0], "Error processing results:") === false)){
                $data['message'] = substr($output[0],7,strlen($output[0])-9);
            }else{
                $data["message"] = $output[0];
            }
        }else{
            $json = json_decode($output[0],true);
            $data["table"] = $json;
            $data['message'] = __('bisection.success');
        }
        return view('bisection')->with("data",$data);
    }
}