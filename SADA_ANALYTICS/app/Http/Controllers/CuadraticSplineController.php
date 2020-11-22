<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuadraticSplineController extends Controller
{
    public function cuadraticSpline(){
        $data = [];
        $data["check"] = "false";
        $data["title"] =  __('cuadratic_spline.title');
        $data["message"] = "Lineal Spline Method";
        return view('cuadraticSpline')->with("data",$data);
    }

    public function cuadraticSplineMethod(Request $request){
        $dimension = $request->input("n");
        $Arrx = []; 
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $command = 'python "'.public_path().'\python\cuadratic_spline.py" '." ".$data. " ".$dimension;
        // $output = explode("\n",substr_replace(shell_exec($command) ,"",-2));
        //dd($output);
        exec($command, $output);
        $data = [];
        $error = json_decode($output[0], true);
        $data["error"] = $error;
        if($error[0] == FALSE){//no errors
            $tracers = json_decode($output[1], true);
            $data["tracers"] = $tracers;
        }
        $data["title"] = __('cuadratic_spline.title');
        $data["arrx"] = $Arrx;
        $data["arry"] = $Arry;
        $data["dimension"] = $dimension;
        dd($data);
        return view('cuadraticSpline')->with("data",$data);
    }
}