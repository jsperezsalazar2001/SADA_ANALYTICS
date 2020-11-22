<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoolittleController extends Controller
{
    public function doolittle(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["title"] = "Doolittle";
        $data["solution"] = "false";
        $data["storage"] = "false";
        $data["message"] = "Doolittle Method";
        return view('doolittle')->with("data",$data);
    }

    public function doolittleMethod(Request $request){
        $data = [];
        $mem = session()->get("mem");
        $indexMem = $mem[8][0];
        $mem[8][0] = $mem[8][0]+1;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        //session()->put("mem",$mem);
        //$mem = session()->get("mem");
        $auxMem = [];

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
        array_push($auxMem,$data_a);
        array_push($auxMem,$data_b);
        array_push($auxMem,$dimension);
        $mem[8][$indexMem] = $auxMem;
        session()->put("mem",$mem);
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        //dd($data["mem"]);


        $data_a = json_encode($data_a);
        $data_b = json_encode($data_b);
        $command = 'python "'.public_path().'\python\doolittle.py" '." ".$data_a." ". $data_b. " {$dimension}";
        exec($command, $output);
        $data["title"] = "Doolittle";
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
            $data["solution"] = "false";
        }else{
            $data["solution"] = "true";
            $data["dimension"] = $dimension;
            $stepL = json_decode($output[1],true);
            $stepU = json_decode($output[2],true);
            $stepL = $this->rebuildArray($stepL);
            $stepU = $this->rebuildArray($stepU);
            $data["stepL"] = $stepL;
            $data["stepU"] = $stepU;
            $xSolution = json_decode($output[0],true);
            $data["xSolution"] = $xSolution;
            $data["message"] = "Success with method";
        }
        return view('doolittle')->with("data",$data);
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
        $data["checkMem"] = "false";
        $data["title"] = "Doolittle";
        $data["solution"] = "false";
        $data["message"] = "Doolittle Method";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        //dd($information);
        $data["information"] = $information;
        $data["storage"] = "true";
        //dd($data);
        return view('doolittle')->with("data",$data);
    }
}