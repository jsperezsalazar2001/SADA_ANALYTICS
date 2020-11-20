<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinealSplinController extends Controller
{
    public function linealSplin(){
        $data = [];
        $data["check"] = "false";
        $data["title"] = "Lineal Splin";
        $data["message"] = "Lineal Splin Method";
        return view('linealSplinMethod')->with("data",$data);
    }

    public function linealSplinMethod(Request $request){
        $dimension = $request->input("n");
        $Arrx = []; 
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $data = [$Arrx,$Arry];
        $data = json_encode($data);
        $command = 'python "'.public_path().'\python\linealSplin.py" '." ".$data. " ".$dimension;
        exec($command, $output);
        #dd($output[0]);
        $data = [];
        $data["title"] = "Lineal Splin";
        if (substr($output[0],7,5) == "Error"){
            $data["check"] = "false";
            $data["message"] = substr($output[0],7,strlen($output[0])-9);
        }else{
            $json = json_decode($output[0], true);
            $arrayAux = [];
            for($i=0; $i<count($json)-1; $i++){
                $aux = "";
                for($j=0;$j<count($json[$i]);$j++){
                    if ($j != count($json[$i])-1){
                        $aux = $aux.$json[$i][$j]." - ";
                    }else{
                        $aux = $aux.$json[$i][$j];
                    }
                }
                array_push($arrayAux,$aux);
            }
            #dd($arrayAux);
            $data["coefficient"] = $arrayAux;
            $plotter = $json["plotter"];
            $plotter = str_replace("*", "", $plotter);
            $data["plotter"] = $plotter;
            $data["check"] = "true";
            $data["arrx"] = $Arrx;
            $data["arry"] = $Arry;
            $data["message"] = "Success with method";
        }
        return view('linealSplinMethod')->with("data",$data);
    }
}