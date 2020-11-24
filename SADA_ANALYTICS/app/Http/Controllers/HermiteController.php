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
        // inicia copiar
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        // Termina Copiar
        return view('hermiteMethod')->with("data",$data);
    }

    public function hermiteMethod(Request $request){
        $Arrx = []; 
        $Arry = [];
        $Arrz = [];
        $dimension = $request->input("n");
        $save = $request->input("save"); // Copiar

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
            array_push($Arrz, $request->input("z".$i));
        }

        // Inicia copiar
        $mem = session()->get("mem");
        $indexMem = $mem[2][0];
        $mem[2][0] = $mem[2][0]+1;
        if ($mem[2][0] > 5){
            $mem[2][0] = 1;
        }
        $auxMem = [];
        if ($save == "save"){
            array_push($auxMem,$Arrx);
            array_push($auxMem,$Arry);
            array_push($auxMem,$dimension);
            $mem[2][$indexMem] = $auxMem;
            session()->put("mem",$mem);
        }

        // Termina copiar
        $auxArrz = $Arrz;
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $Arrz = json_encode($Arrz);
        $command = 'python3 "'.public_path().'/python/hermite.py" '." ".$data. " ".$Arrz. " ".$dimension;
        exec($command, $output);
        $data = [];

        //Inicia copiar
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";

        // Termina copiar
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

    // Copiar metodo
    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Hermite"; // Cambiar el titulo
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('hermiteMethod')->with("data",$data); // Cambiar la ruta. Primera ventana del metodo
    }
}