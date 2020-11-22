<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IterativeMethodJGBController extends Controller
{
    public function iterativeMethodJGB(){
        $data = [];
        $data["title"] = __('iterative_j_g_b_method.title');
        $data["solution"] = "false";
        $data["table"] = "";
        return view('iterativeMethodJGB')->with("data",$data);
    }

    public function values(Request $request){
        $data_a = []; 
        $dimension = $request->input("n");
        $data_b = [];
        $data_x = [];
        $method_type = $request->input("method_type");
        $tolerance = $request->input("tolerance");
        $iteration = $request->input("iteration");

        for ($i=0; $i < $dimension; $i++) { 
            $array_a =[];
            array_push($data_b, $request->input("vector".$i));
            array_push($data_x, $request->input("vector_x".$i));
          for ($j=0; $j < $dimension; $j++) { 
              array_push($array_a,$request->input("matrix".$i.$j));
          }
          array_push($data_a, $array_a);
        }

        $data_a = json_encode($data_a);
        $data_b = json_encode($data_b);
        $data_x = json_encode($data_x);

        if ($method_type != "SOR") {
            $command = 'python "'.public_path().'\python\iterative_methodJ_GB.py" '." ".$data_a." ". $data_b." "."{$method_type}"." ". $data_x." "."{$tolerance}"." "."{$iteration}";
        }else{
            $w = $request->input("w");
            $command = 'python "'.public_path().'\python\iterative_method_S.py" '." ".$data_a." ". $data_b." "."{$method_type}"." ". $data_x." "."{$tolerance}"." "."{$iteration}"." "."{$w}";
        }
        
        exec($command, $output);

        $data["title"] = __('factorization_l_u_method.title');
        $data["solution"] = "true";
        $data["dimension"] = $dimension;
        
        $json_matrix = json_decode($output[0],true);
        $json_table = json_decode($output[1],true);

        
        $json_matrix["T"]= $this->rebuildArrayJacobi($json_matrix["T"]);
        
        $data["json_matrix"] = $json_matrix;
        $data["json_table"] = $json_table;
        
        return view('iterativeMethodJGB')->with("data",$data);
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

    public function rebuildArrayJacobi($array){
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