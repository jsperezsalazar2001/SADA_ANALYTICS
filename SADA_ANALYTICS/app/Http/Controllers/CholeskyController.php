<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CholeskyController extends Controller
{
    public function cholesky(){
        $data = [];
        $data["title"] = __('cholesky.title');
        $data["solution"] = "form";
        return view('cholesky')->with("data",$data);
    }

    public function choleskyMethod(Request $request){
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

        $command = escapeshellcmd('python "'.public_path().'\python\cholesky.py" '." ".$data_a." ". $data_b);
        //$output = explode("\n",substr_replace(shell_exec($command) ,"",-2));
        //dd($output);
        exec($command, $output);
        $data["title"] = __('cholesky.title');
        $error = json_decode($output[0],true);

        $matrixA = json_decode($output[1],true);
        $stepL = json_decode($output[2],true);
        $stepU = json_decode($output[3],true);

        if ($error["error"] == False){
            $data["solution"] = "true";
            $xSolution = json_decode($output[4],true);
            $data["xSolution"] = $xSolution;
        }else{
            $data["solution"] = "false";
        }

        $matrixA = $this->rebuildArray($matrixA, 0);
        $stepL = $this->rebuildArray($stepL, 1);
        $stepU = $this->rebuildArray($stepU, 1);

        $data["error"] = $error;
        $data["matrixA"] = $matrixA;
        $data["stepL"] = $stepL;
        $data["stepU"] = $stepU;
        //dd($data);
        return view('cholesky')->with("data",$data);
    }

    public function rebuildArray($array,$start_index){
        $aux_array = [];
        $aux2_array = [];
            
        for ($i=0; $i < count($array) ; $i++) { 
            for ($j=0; $j < count($array[$i+$start_index]) ; $j++) { 
                $temporal = substr($array[$i+$start_index][$j],1,strlen($array[$i+$start_index][$j])-2);
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