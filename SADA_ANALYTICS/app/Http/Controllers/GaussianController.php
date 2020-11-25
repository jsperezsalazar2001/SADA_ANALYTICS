<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaussianController extends Controller
{
    public function gaussian(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        
        $data["title"] = __('gaussian_method.title');
        $data["solution"] = "false";
        $data["table"] = "";
        return view('gaussian')->with("data",$data);
    }

    public function values(Request $request){
        $data= [];
        $mem = session()->get("mem");
        $indexMem = $mem[1][0];
        $mem[1][0] = $mem[1][0]+1;
        if ($mem[1][0]>5) {
            $mem[1][0] = 1;
        }
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $save = $request->input("save");

        $data_a = []; 
        $dimension = $request->input("n");
        $data_b = [];
        $method_type = $request->input("method_type");

        for ($i=0; $i < $dimension; $i++) { 
            $array_a =[];
            array_push($data_b, $request->input("vector".$i));
          for ($j=0; $j < $dimension; $j++) { 
              array_push($array_a,$request->input("matrix".$i.$j));
          }
          array_push($data_a, $array_a);
        }

        $auxMem = [];
        if ($save == "save"){
            array_push($auxMem,$data_a);
            array_push($auxMem,$data_b);
            array_push($auxMem,$dimension);
            $mem[1][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }
        $mem = session()->get("mem");
        $data["mem"] = $mem;

        $data_a = json_encode($data_a);
        $data_b = json_encode($data_b);
        //$command = 'python "'.public_path().'\python\check_matrix.py" '." ".$data_a." ". $data_b. " {$method_type}";
        $command = 'python3 "'.public_path().'/python/check_matrix.py" '." ".$data_a." ". $data_b. " {$method_type}";
        exec($command, $output);

        $data["title"] = __('gaussian_method.title');
        #dd($output);
        if (substr($output[0],7,5) == "Error"){
            $data["solution"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $data["solution"] = "true";
            $data["dimension"] = $dimension;
            $json = json_decode($output[0],true);
            $solution_array = $json["x"];
            array_pop($json); 
            $json = $this->rebuildArray($json);
            $json["x"] = $solution_array;
            $data["table"] = $json;
        }
        
        return view('gaussian')->with("data",$data);
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

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] =  __('gaussian_method.title');
        $data["solution"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('gaussian')->with("data",$data);
    }
}