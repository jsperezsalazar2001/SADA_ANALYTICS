<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HermiteController extends Controller
{
    public function hermite(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = "Hermite";
        return view('hermiteMethod')->with("data",$data);
    }

    public function hermiteMethod(Request $request){
        $Arrx = []; 
        $Arry = [];
        $Arrz = [];
        $dimension = $request->input("n");

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
            array_push($Arrz, $request->input("z".$i));
        }
        $auxArrz = $Arrz;
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $Arrz = json_encode($Arrz);
        $command = 'python "'.public_path().'\python\hermite.py" '." ".$data. " ".$Arrz. " ".$dimension;
        exec($command, $output);
        $data = [];
        $data["title"] = "Hermite";
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
            $data["arrz"] = $auxArrz;
            $data["message"] = "Success with method";
            $data["dimension"] = $dimension;
        }
        return view('hermiteMethod')->with("data",$data);
    }
}