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

}