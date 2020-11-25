<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaussianTridiagonalMatrixMethodController extends Controller
{
    public function GaussianTridiagonalMatrix(){
        $data = [];
        $data["solution"] = "false";
        $data["title"] = __('gaussian_tridiagonal_matrix.title');
        #$data["message"] = __('gaussian_tridiagonal_matrix.title');
        return view('gaussianTridiagonalMatrixMethod')->with("data",$data);
    }

    public function GaussianTridiagonalMatrixMethod(Request $request){
        
        $dimension = $request->input("n");
        $Arra = []; 
        $Arrb = [];
        $Arrc = []; 
        $Arrd = [];

        for ($i=0; $i < $dimension; $i++) {
            if ($i>0) {
                array_push($Arra, $request->input("a".$i));
                array_push($Arrc, $request->input("c".$i));
             } 
            array_push($Arrb, $request->input("b".$i));
            array_push($Arrd, $request->input("d".$i));
        }
        $Arra = json_encode($Arra);
        $Arrb = json_encode($Arrb);
        $Arrc = json_encode($Arrc);
        $Arrd = json_encode($Arrd);

        //$command = 'python3 "'.public_path().'/python/gaussian_tridiagonal_matrix_method.py" '." ".$Arra." ". $Arrb." ".$Arrc." ".$Arrd;
        $command = 'python "'.public_path().'\python\gaussian_tridiagonal_matrix_method.py" '." ".$Arra." ".$Arrb." ".$Arrc." ".$Arrd;
        exec($command, $output);
        
        $data = [];
        $data["title"] = __('gaussian_tridiagonal_matrix.title');
        #dd($output);
        if (substr($output[0],7,5) == "Error"){
            $data["solution"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            
            $data["title"] = __('gaussian_tridiagonal_matrix.title');
            $data["solution"] = "true";
            $data["dimension"] = $dimension;
            $json = json_decode($output[0],true);
            $solution_array = $json["x"];
            array_pop($json); 
            $json = $this->rebuildArray($json);
            $json["x"] = $solution_array;
            $data["table"] = $json;
            #dd($data);
        }
        return view('gaussianTridiagonalMatrixMethod')->with("data",$data);
    }

    public function rebuildArray($array){
        $aux_array = [];
        $aux2_array = [];
        #dd($array);
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
        #dd($aux_array);
        return $aux2_array;
    }
}