<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LagrangeController extends Controller
{
    public function lagrange(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = "Lagrange";
        $data["message"] = "Metodo de Lagrange";
        return view('lagrangeMethod')->with("data",$data);
    }

    public function lagrangeMethod(Request $request){
        $Arrx = []; 
        $dimension = $request->input("n");
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $command = 'python "'.public_path().'\python\lagrange.py" '." ".$data. " ".$dimension;
        exec($command, $output);
        $data = [];
        $data["title"] = "Lagrange";
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            dd($output[0]);
            $json = json_decode($output[0], true);
            dd(gettype($json));
            for ($i=0; $i < count($output)-1; $i++){
                $data[$i] = $output[$i];
                $data[$i] = str($data[$i]);
                $data[$i] = str_replace("**", "^", $data[$i]);
            }
            $data["polynomial"] = $output[count($output)-1];
            //$data["polynomial"] = str($data["polynomial"]);
            //$data["polynomial"] = str_replace("**", "^", $data["polynomial"]);
            $data["check"] = "true";
            dd($data);


            /*$json = json_decode($output[0],true);
            $data["json"] = $json;
            $data["check"] = "true";
            $data["x_0"] = $x_0;
            $data["x_1"] = $x_1;
            $data["x_2"] = $x_2;
            $data["iterations"] = $iterations;
            $data["function"] = $originalfunction;
            $data["tolerance"] = $tolerance;
            $data["message"] = __('muller.succesful');*/
        }
        return view('mullerMethod')->with("data",$data);
    }
}