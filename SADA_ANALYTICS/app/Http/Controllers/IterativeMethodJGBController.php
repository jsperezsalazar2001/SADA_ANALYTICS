<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IterativeMethodJGBController extends Controller
{
    public function iterativeMethodJGB(){
        $data = [];
        $data["title"] = __('factorization_l_u_method.title');
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
        $command = 'python "'.public_path().'\python\iterative_methodJ_GB.py" '." ".$data_a." ". $data_b. " {$method_type}"." ". $data_x;
        exec($command, $output);

        $data["title"] = __('factorization_l_u_method.title');
        $data["solution"] = "true";
        $data["dimension"] = $dimension;
        
        $json_l = json_decode($output[1],true);
        $json_u = json_decode($output[2],true);

        $json_l = $this->rebuildArray($json_l);
        $json_u = $this->rebuildArray($json_u);

        $data["table_l"] = $json_l;
        $data["table_u"] = $json_u;
        
        $json = json_decode($output[0],true);
        $solution_array = $json["x"];
        array_pop($json); 
        $json = $this->rebuildArray($json);
        $json["x"] = $solution_array;
        $data["table"] = $json;
        #dd($data);
        return view('factorizationLU')->with("data",$data);
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