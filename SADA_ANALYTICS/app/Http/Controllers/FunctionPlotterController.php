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

    public function grapherUri($function){
        $data = [];
        $data["title"] = __('function_plotter.title');
        $data["function"] = urldecode($function);
        dd($function);
        return view('functionPlotter')->with("data",$data);
    }

}