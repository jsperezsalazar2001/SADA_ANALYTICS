<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecantController extends Controller
{
    public function secant(){
        $data = [];
        $data["title"] = __('secant.title');
        return view('secant')->with("data",$data);
    }

    public function secantMethod(Request $request){
        $f_function = $request->input('f_function');
        $data['f_function'] = $f_function;
        $f_function = '"'.$f_function.'"';
        $x1 = $request->input('x1');
        $x2 = $request->input('x2');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');
        $data['x1'] = $x1;
        $data['x2'] = $x2;
        $data['tolerance'] = $tolerance;
        $data['iterations'] = $iterations;
        //$command = 'python "'.public_path().'\python\secant.py" '."{$f_function} {$x1} {$x2} {$tolerance} {$iterations}";
        $command = 'python3 "'.public_path().'/python/secant.py" '."{$f_function} {$x1} {$x2} {$tolerance} {$iterations}";
        exec($command, $output);
        $data["title"] = __('secant.title');
        if (!(strpos($output[0], "Error") === false)){
            if ((strpos($output[0], "Error processing results:") === false)){
                $data['message'] = substr($output[0],7,strlen($output[0])-9);
            }else{
                $data["message"] = $output[0];
            }
        }else{
            $json = json_decode($output[0],true);
            $data["table"] = $json;
            $data['message'] = __('secant.success');
        }
        return view('secant')->with("data",$data);
    }
}