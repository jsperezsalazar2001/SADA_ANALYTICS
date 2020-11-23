<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncrementalSearchController extends Controller
{
    public function incrementalSearch(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = __('incremental.title');
        return view('incrementalMethod')->with("data",$data);
    }

    public function incrementalSearchMethod(Request $request){
        $x_0 = $request->input('x_0');
        $delta = $request->input('delta');
        $iterations = $request->input('iterations');
        $originalFunction = $request->input('function');
        $function = '"'.$originalFunction.'"';
        $command = 'python "'.public_path().'\python\incremental_search.py" '."{$x_0} {$delta} {$iterations} {$function}";
        exec($command, $output);
        $data = [];
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
            $data["message"] = __('incremental.succesful');;
        }
        return view('incrementalMethod')->with("data",$data);
    }
}