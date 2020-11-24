<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        #$mem = session()->forget("mem");
        $mem = session()->get("mem");
        if ($mem == null){
            $functions = [1];
            $matrix = [1];
            $interpolation = [1];
            $mem[0] = $functions;
            $mem[1] = $matrix;
            $mem[2] = $interpolation;
        }
        session()->put("mem",$mem);
        return view('homePage');
    }
}