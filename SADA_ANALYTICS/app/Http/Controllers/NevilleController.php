<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NevilleController extends Controller
{
    public function neville(){
        $data = [];
        $data["check"] = "false";
        $data["title"] =  __('neville.title');
        
        
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";


        return view('neville')->with("data",$data);
    }

    public function nevilleMethod(Request $request){
        $dimension = $request->input("n");
        $x_inter = $request->input("x_inter");
        $Arrx = []; 
        $Arry = [];

        for ($i=0; $i < $dimension; $i++) { 
            array_push($Arrx, $request->input("x".$i));
            array_push($Arry, $request->input("y".$i));
        }
        $data = [$Arrx,$Arry];
        $data = json_encode($data);

        $save = $request->input("save");
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

        $command = 'python3 "'.public_path().'/python/neville_method.py" '." ".$data." ".$dimension." ".$x_inter;
        // $output = explode("\n",substr_replace(shell_exec($command) ,"",-2));
        //dd($output);
        exec($command, $output);
        //dd($output);
        $data = [];

        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $data["checkMem"] = "true";
        $data["storage"] = "false";
        
        $error = json_decode($output[0], true);
        $data["error"] = $error;
        if($error[0] == FALSE){//no errors
            $interpolated_y = json_decode($output[1], true);
            $data["interpolated_y"] = $interpolated_y;
        }
        $data["title"] = __('neville.title');
        $data["arrx"] = $Arrx;
        $data["arry"] = $Arry;
        $data["dimension"] = $dimension;
        $data["check"] = "true";
        return view('neville')->with("data",$data);
    }

    public function storage($storage,$method){
        $data = [];
        $data["checkMem"] = "true";
        $data["title"] =  __('neville.title');
        $data["check"] = "false";
        $mem = session()->get("mem");
        $data["mem"] = $mem;
        $information = $data["mem"][$method][$storage];
        $data["information"] = $information;
        $data["storage"] = "true";
        return view('neville')->with("data",$data);
    }
}