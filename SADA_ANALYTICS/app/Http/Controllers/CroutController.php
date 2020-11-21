<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CroutController extends Controller
{
    public function crout(){
        $data = [];
        $data["title"] = "Crout";
        $data["solution"] = "false";
        $data["message"] = "Crout Method";
        #$data["table"] = "";
        return view('crout')->with("data",$data);
    }

    public function croutMethod(Request $request){
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

        $command = 'python "'.public_path().'\python\crout.py" '." ".$data_a." ".$data_b;
        exec($command, $output);
        //dd($output);
        $data["title"] = "Crout";
        $data["solution"] = "true";
        $data["dimension"] = $dimension;
        $stepA = json_decode($output[1],true);
        $stepL = json_decode($output[2],true);
        $stepU = json_decode($output[3],true);

        $stepA = $this->rebuildArray($stepA);
        $stepL = $this->rebuildArray($stepL);
        $stepU = $this->rebuildArray($stepU);
        $data["stepA"] = $stepA;
        $data["stepL"] = $stepL;
        $data["stepU"] = $stepU;
        $xSolution = json_decode($output[0],true);
        $data["xSolution"] = $xSolution;

        
        return view('crout')->with("data",$data);
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