<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LagrangeController extends Controller
{
    public function lagrange(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = "Lagrange";
        $data["message"] = "Metodo de Lagrange";
        return view('lagrangeMethod')->with("data",$data);
    }

    public function lagrangeMethod(Request $request){
        $Arrx = []; 
        $dimension = $request->input("n");
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $command = 'python "'.public_path().'\python\lagrange.py" '." ".$data. " ".$dimension;
        exec($command, $output);
        $data = [];
        $data["title"] = "Lagrange";
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $json = json_decode($output[0], true);
            $arrayAux = [];
            for($i=0; $i<count($json)-1; $i++){
                $aux = $json[$i];
                $aux = str_replace("**","^",$aux);
                $aux = str_replace("*","",$aux);
                $arrayAux[$i] = $aux;
            }

            $data["coefficient"] = $arrayAux;
            $polynomial = $json["polynomial"];
            $polynomial = str_replace("**", "^", $polynomial);
            $polynomial = str_replace("*", "", $polynomial);
            $data["polynomial"] = $polynomial;
            $data["check"] = "true";
            $data["arrx"] = $Arrx;
            $data["arry"] = $Arry;
            $data["message"] = "Success with method";
        }
        return view('lagrangeMethod')->with("data",$data);
    }
}