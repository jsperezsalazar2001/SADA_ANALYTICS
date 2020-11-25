<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunctionPlotterController extends Controller
{
    public function grapher(){
        $data = [];
        $data["title"] = __('function_plotter.title');
        return view('functionPlotter')->with("data",$data);
    }
    public  function grapherUri(Request $request){
        $data = [];
        $function = $request->input('f_function');
        $function = str_replace("ln","log", $function);
        $data["title"] = __('function_plotter.title');
        $data["function"] = ($function);
        return view('functionPlotter')->with("data",$data);
    }

}