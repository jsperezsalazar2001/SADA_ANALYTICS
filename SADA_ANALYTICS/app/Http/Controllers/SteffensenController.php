<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SteffensenController extends Controller
{
    public function steffensen(){
        $data = [];
        $data["title"] = __('steffensen.title');
        return view('steffensen')->with("data",$data);
    }

    public function steffensenMethod(Request $request){
        $f_function = $request->input('f_function');
        $f_function = '"'.$f_function.'"';
        $initial_x = $request->input('initial_x');
        $tolerance = $request->input('tolerance');
        $iterations = $request->input('iterations');
        $command = 'python "'.public_path().'\python\steffensen.py" '."{$f_function} {$initial_x} {$tolerance} {$iterations}";
        exec($command, $output);
        dd($output);
    }
}