<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecantController extends Controller
{
    public function secant(){
        $data = [];
        $data["title"] = __('secant.title');
        return view('secant')->with("data",$data);
    }

    public function secantMethod(Request $request){
        $f_function = $request->input('f_function');
        $f_function = '"'.$f_function.'"';
        $x1 = $request->input('x1');
        $x2 = $request->input('x2');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');
        $command = 'python "'.public_path().'\python\secant.py" '."{$f_function} {$x1} {$x2} {$tolerance} {$iterations}";
        exec($command, $output);
        dd($output);
    }
}