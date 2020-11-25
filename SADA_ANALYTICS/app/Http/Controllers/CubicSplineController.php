<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CubicSplineController extends Controller
{
    public function cubicSpline(){
        $data = [];
        $data["check"] = "false";
        $data["title"] =  __('cubic_spline.title');

        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";


        return view('cubicSpline')->with("data",$data);
    }

    public function cubicSplineMethod(Request $request){
        $dimension = $request->input("n");
        $Arrx = []; 
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $data = [$Arrx,$Arry];
        $data = json_encode($data);

        $save = $request->input("save");
        $mem = session()->get("mem");
        $indexMem = $mem[2][0];
        $mem[2][0] = $mem[2][0]+1;
        if ($mem[2][0] > 5){
            $mem[2][0] = 1;
        }
        $auxMem = [];
        if ($save == "save"){
            array_push($auxMem,$Arrx);
            array_push($auxMem,$Arry);
            array_push($auxMem,$dimension);
            $mem[2][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }


        $command = 'python3 "'.public_path().'/python/cubic_spline.py" '." ".$data. " ".$dimension;
        // $output = explode("\n",substr_replace(shell_exec($command) ,"",-2));
        //dd($output);
        exec($command, $output);
        $data = [];

        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";


        $error = json_decode($output[0], true);
        $data["error"] = $error;
        if($error[0] == FALSE){//no errors
            $tracers = json_decode($output[1], true);
            $data["tracers"] = $tracers;
        }
        $data["title"] = __('cubic_spline.title');
        $data["arrx"] = $Arrx;
        $data["arry"] = $Arry;
        $data["dimension"] = $dimension;
        $data["check"] = "true";
        //dd($data);
        return view('cubicSpline')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] =  __('cubic_spline.title');
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('cubicSpline')->with("data",$data);
    }
}