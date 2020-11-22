<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VandermondeController extends Controller
{
    public function vandermonde(){
        $data = [];
        $data["solution"] = "false";
        $data["title"] = "Vandermonde";
        $data["message"] = "Vandermonde Method";
        return view('vandermondeMethod')->with("data",$data);
    }

    public function vandermondeMethod(Request $request){
        $Arrx = []; 
        $dimension = $request->input("n");
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $Arrx = json_encode($Arrx);
        $Arry = json_encode($Arry);

        $command = 'python "'.public_path().'\python\vandermonde.py" '." ".$Arrx." ".$Arry;
        exec($command, $output);
        $data = [];
        //dd($output[0]);
        $data["title"] = "Vandermonde";
        $data["solution"] = "true";
        $data["dimension"] = $dimension;
        $json = json_decode($output[0], true);
        $v_matrix = $json["v_matrix"];
        $coef = $json["coef"];
        $polynomial = $json["polynomial"];

        //dd($coef);
        $v_matrix = $this->rebuildArray($v_matrix);

        $data["v_matrix"] = $v_matrix;
        $data["coef"] = $coef;
        $data["polynomial"] = $polynomial;

        return view('vandermondeMethod')->with("data",$data);
    }

    public function rebuildArray($array){
        $aux_array = [];
        $aux2_array = [];
            
        for ($i=0; $i < count($array) ; $i++) { 
            
            $temporal = substr($array[$i],1,strlen($array[$i])-2);
            $temporal = str_replace("'","",$temporal);
            $temporal = explode(" ",$temporal);
            array_push($aux_array, $temporal);
           
        }

        return $aux_array;
    }
}