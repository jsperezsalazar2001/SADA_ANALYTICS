<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LagrangeController extends Controller
{
    public function lagrange(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["check"] = "false";
        $data["title"] = "Lagrange";
        $data["storage"] = "false";
        return view('lagrangeMethod')->with("data",$data);
    }

    public function lagrangeMethod(Request $request){
        $Arrx = []; 
        $dimension = $request->input("n");
        $save = $request->input("save");
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
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
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $command = 'python "'.public_path().'\python\lagrangeMethod.py" '." ".$data. " ".$dimension;
        //$command = 'python3 "'.public_path().'/python/lagrangeMethod.py" '." ".$data. " ".$dimension;
        exec($command, $output);
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
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
        }
        return view('lagrangeMethod')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Lagrange";
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('lagrangeMethod')->with("data",$data);
    }
}