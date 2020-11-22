<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SteppedController extends Controller
{
    public function stepped(){
        $data = [];
        $data["title"] = "Stepped Partial Pivot";
        $data["solution"] = "false";
        $data["message"] = "Stepped Partial Pivot Method";
        #$data["table"] = "";
        return view('stepped')->with("data",$data);
    }

    public function steppedMethod(Request $request){
        $data_a = []; 
        $dimension = $request->input("n");
        $data_b = [];
        for ($i=0; $i < $dimension; $i++) { 
            $array_a =[];
            array_push($data_b, $request->input("vector".$i));
          for ($j=0; $j < $dimension; $j++) { 
              array_push($array_a,$request->input("matrix".$i.$j));
          }
          array_push($data_a, $array_a);
        }

        $data_a = json_encode($data_a);
        $data_b = json_encode($data_b);
        $command = 'python "'.public_path().'\python\stepped.py" '." ".$data_a." ". $data_b;
        exec($command, $output);
        $data["title"] = "Stepped Partial Pivot";
        $data["solution"] = "true";
        $matrix = json_decode($output[0],true);
        $matrix = $this->rebuildArray($matrix);
        $data["matrix"] = $matrix;
        $xSolution = json_decode($output[1],true);
        $data["xSolution"] = $xSolution;
        return view('stepped')->with("data",$data);
    }

    public function rebuildArray($array){
        $aux_array = [];
        $aux2_array = [];
            
        for ($i=0; $i < count($array) ; $i++) { 
            for ($j=0; $j < count($array[$i]) ; $j++) { 
                $temporal = substr($array[$i][$j],1,strlen($array[$i][$j])-2);
                $temporal = str_replace("'","",$temporal);
                $temporal = explode(" ",$temporal);
                array_push($aux_array, $temporal);
            }
            array_push($aux2_array, $aux_array);
            $aux_array=[];
        }

        return $aux2_array;
    }
}