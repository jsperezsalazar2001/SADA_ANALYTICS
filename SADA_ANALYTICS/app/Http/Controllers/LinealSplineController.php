<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinealSplineController extends Controller
{
    public function linealSpline(){
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["check"] = "false";
        $data["title"] = "Lineal Spline";
        return view('linealSplineMethod')->with("data",$data);
    }

    public function linealSplineMethod(Request $request){
        $dimension = $request->input("n");
        $save = $request->input("save");
        $Arrx = []; 
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
        $command = 'python "'.public_path().'\python\linealSpline.py" '." ".$data. " ".$dimension;
        exec($command, $output);
        $data = [];
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        $data["title"] = "Lineal Spline";
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
                        $aux = $aux.$json[$i][$j]." , ";
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
        return view('linealSplineMethod')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] = "Lineal Spline";
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        //dd($data);
        return view('linealSplineMethod')->with("data",$data);
    }
}