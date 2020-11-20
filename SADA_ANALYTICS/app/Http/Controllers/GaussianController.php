<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaussianController extends Controller
{
    public function gaussian(){
        $data = [];
        $data["title"] = __('gaussian_method.title');
        $data["solution"] = "false";
        $data["table"] = "";
        return view('gaussian')->with("data",$data);
    }

    public function values(Request $request){
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

        $data_a = json_encode($data_a);
        $data_b = json_encode($data_b);
        $command = 'python "'.public_path().'\python\check_matrix.py" '." ".$data_a." ". $data_b. " {$method_type}";
        exec($command, $output);

        $data["title"] = __('gaussian_method.title');
        $data["solution"] = "true";
        $data["dimension"] = $dimension;
        $json = json_decode($output[0],true);
        $data["table"] = $json;
        
        return view('gaussian')->with("data",$data);
    }
}