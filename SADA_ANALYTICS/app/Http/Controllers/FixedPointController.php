<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FixedPointController extends Controller
{
    public function fixedPoint(){
        $data = [];
        $data["title"] = __('fixed_point.title');
        return view('fixedPoint')->with("data",$data);
    }

    public function fixedPointMethod(Request $request){
        $f_function = $request->input('f_function');
        $f_function = '"'.$f_function.'"';
        $g_function = $request->input('g_function');
        $g_function = '"'.$g_function.'"';
        $initial_x = $request->input('initial_x');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');
        $command = 'python "'.public_path().'\python\fixed_point.py" '."{$f_function} {$g_function} {$initial_x} {$tolerance} {$iterations}";
        exec($command, $output);
        dd($output);
    }
}